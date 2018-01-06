<?php
namespace Modules\Reports\Reports;


use Modules\Process\Entities\QualityParameter;
use Carbon\Carbon;
use PDF;

class SurimiPoNumberwiseQualityReport extends AbstractReport
{
    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'product_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Product Date',
            'type' => REPORT_RELATION_COLUMN,
            'format' => REPORT_DATE_FORMAT,
            'relation_column' => 'product_date'
        ],
        'carton_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'format' => REPORT_DATE_FORMAT,
            'relation_column' => 'carton_date'
        ],
        'inspection_date'=>[
            'column_name'=>'inspection_date',
            'format' => REPORT_DATE_FORMAT,
            'display_name'=>'Inspection Date',
        ],
        'variety'=> [
            'column_name'=>'carton.product',
            'display_name'=>'Variety',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'fishtype'
        ],
        'cm'=> [
            'column_name'=>'carton.product.cm',
            'display_name'=>'CM',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'cm'
        ],
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'qcr_pagrno'=>[
            'column_name'=>'qcr_pageno',
            'display_name'=>'QCR PAGE',
        ],
        'no_of_cartons'=>[
            'column_name'=>'carton.product',
            'display_name'=>'No.Of.Cartons',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'no_of_cartons'
        ],
        'grade'=>[
            'column_name'=>'grades',
            'display_name'=>'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'grade'
        ],
        'ic'=>[
            'column_name'=>'ic',
            'display_name'=>'IC',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'internal_code'
        ],
        'moisture'=> [
            'column_name'=>'moisture',
            'display_name'=>'Moisture',
        ],
        'standar_wf'=> [
            'column_name'=>'work_force',
            'display_name'=>'W',
        ],
        'standard_l'=>[
            'column_name'=>'length',
            'display_name'=>'L',
        ],
        'standard_gl'=> [
            'column_name'=>'gel_strength',
            'display_name'=>'JS',
        ],
        'suwari_wf'=>[
            'column_name'=>'suwari_work_force',
            'display_name'=>'20%W',
        ],
        'suwari_l'=> [
            'column_name'=>'suwari_length',
            'display_name'=>'20%L',
        ],
        'suwari_gl'=>[
            'column_name'=>'gel_strength',
            'display_name'=>'20%JS',
        ],
        'kamaboko_hw'=> [
            'column_name'=>'kamaboko_hw',
            'display_name'=>'Kamaboko HW',
        ],
        'contam'=> [
            'column_name'=>'contam',
            'display_name'=>'Contam',
        ],
        'ph'=> [
            'column_name'=>'ph',
            'display_name'=>'PH',
        ],
        'shipped_qty' => [
            'column_name'=>'carton',
            'display_name'=>'SHIPPED',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'shipped'
        ],
        'po_no' => [
            'column_name'=>'carton.product',
            'display_name'=>'PO No:',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'po_no'
        ],
         'container_no' => [
            'column_name'=>'container_no',
            'display_name'=>'Container No',
            
        ]

    ];


    public function setup(){
        
        if($this->po != null || $this->po != "")
        {
            $this->reportMaster->sub_title = 'PO No: ' . $this->po;
            $queryBuilder = QualityParameter::with('carton','ic','carton.product','carton.product.approval','carton.product.buyer','user')->whereHas('carton.product' ,function($q){
                $q->where('po_no',$this->po );});
        }
        else{
            if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
            {
                $this->reportMaster->sub_title = 'Production Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
            }
            else{
                $this->reportMaster->sub_title = 'Production From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Production To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
            }
            
            
            $queryBuilder = QualityParameter::with('carton','ic','carton.product','carton.product.approval','carton.product.buyer','user')->whereHas('carton.product' ,function($q){
                $q->whereDate('product_date' , '>=' , $this->startDate)->whereDate('product_date' ,'<=',$this->endDate);});
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = ' Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name .' , ' .'Date & Time :' . Carbon::now()->format(PHP_DATE_TIME_FORMAT) ;


        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
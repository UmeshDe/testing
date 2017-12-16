<?php
namespace Modules\Reports\Reports;


use Modules\Process\Entities\QualityParameter;
use Carbon\Carbon;
use PDF;

class SurimiQualityReport extends AbstractReport
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
            'relation_column' => 'product_date'
        ],
        'carton_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'carton_date'
        ],
        'approval_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Approval No',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'app_number'
        ],
        'variety'=> [
            'column_name'=>'kinds',
            'display_name'=>'Variety',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'kind'
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
        'inspection_date'=>[
            'column_name'=>'inspection_date',
            'display_name'=>'Inspection Date',
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
        'ic'=> [
            'column_name'=> 'ic',
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
        'bc'=>[
            'column_name'=>'carton.product',
            'display_name'=>'BC',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'buyer'
        ],
    ];


    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Inspection Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->reportMaster->sub_title = 'Inspection From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Inspection To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by:_________________'.'Varified by :_________________  '. 'Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name  ;

        $this->reportMaster->subfooter = $this->sum;

        $queryBuilder = QualityParameter::with('carton','ic','carton.product','carton.product.approval','carton.product.buyer','user','kinds')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
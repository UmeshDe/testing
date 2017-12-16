<?php
namespace Modules\Reports\Reports;


use Modules\Process\Entities\Shipment;
use Modules\Process\Entities\ShipmentCarton;
use Carbon\Carbon;
use PDF;

class BuyerCodewiseShipmentReport extends AbstractReport
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
        'variety'=> [
            'column_name'=>'carton.product.fishtype',
            'display_name'=>'Variety',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'type'
        ],
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'qcr_pageno'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'QCR PAGE',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'qcr_pageno'
        ],
        'inspection_date'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Inspection Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'inspection_date'
        ],
        'total_cartons'=> [
            'column_name'=>'carton',
            'display_name'=>'Total Cartons',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'no_of_cartons'
        ],
        'grade'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'grade'
        ],
        'moisture'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Moisture',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'moisture'
        ],
        'standar_wf'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'W',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'work_force'
        ],
        'standard_l'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'L',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'length'
        ],
        'standard_gl'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'JS',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'gel_strength'
        ],
        'suwari_wf'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'20%W',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'suwari_work_force'
        ],
        'suwari_l'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'20%L',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'suwari_length'
        ],
        'suwari_gl'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'20%JS',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'gel_strength'
        ],
        'kamaboko_hw'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Kamaboko HW',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'kamaboko_hw'
        ],
        'contam'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Contam',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'contam'
        ],
        'ph'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'PH',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'ph'
        ],
        'shipped_qty'=>[
            'column_name'=>'quantity',
            'display_name'=>'Shipped QTY',
        ],
        'po_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'PO No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'po_no'
        ],
        'container_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Container No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'container_no'
        ],
    ];


    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->reportMaster->sub_title = 'From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by :_________________'.'   Verified by :_________________  '. 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name ;

//        $queryBuilder = ShipmentCarton::with('carton','carton.product','carton.product.fishtype','shipment')->whereHas('shipment' ,function($q){
//            $q->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));});

        $queryBuilder = ShipmentCarton::with('carton','carton.product','carton.product.fishtype','shipment')->whereHas('carton.product' ,function($q){
            $q->where('buyercode_id', $this->buyer );});


        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
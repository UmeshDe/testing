<?php
namespace Modules\Reports\Reports;


use Modules\Process\Entities\Shipment;
use Modules\Process\Entities\ShipmentCarton;
use Carbon\Carbon;
use PDF;

class ShipmentReport extends AbstractReport
{
    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'vehicle_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Vehicle No:',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'vehicle_no'
        ],
        'container_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Container No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'container_no'
        ],
        'stuffing_place'=> [
            'column_name'=>'shipment',
            'display_name'=>'Stuffing Place',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'location'
        ],
        'start_time'=>[
            'column_name'=>'shipment',
            'display_name'=>'Start Time',
            'type' => REPORT_RELATION_COLUMN,REPORT_DATE_FORMAT,
            'relation_column' =>'start_time'
        ],
        'end_time'=> [
            'column_name'=>'shipment',
            'display_name'=>'End Time',
            'type' => REPORT_RELATION_COLUMN,REPORT_DATE_FORMAT,
            'relation_column' =>'end_time'
        ],
        'invoice_no'=> [
            'column_name'=>'shipment',
            'display_name'=>'Invoice No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'invoice_no'
        ],
        'approval_no'=> [
            'column_name'=>'carton.product.approval',
            'display_name'=>'Approval No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'app_number'
        ],
        'varity'=> [
            'column_name'=>'carton.product.fishtype',
            'display_name'=>'Varity',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'type'
        ],
        'grade'=> [
            'column_name'=>'grade',
            'display_name'=>'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'Grade'
        ],
        'total_cartons'=> [
            'column_name'=>'carton',
            'display_name'=>'Total Cartons',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'no_of_cartons'
        ],
        'cartons_loading'=>[
            'column_name'=>'quantity',
            'display_name'=>'Cartons Loading',
        ],
        'seal_no'=> [
            'column_name'=>'shipment',
            'display_name'=>'Seal No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'seal_no'
        ],
        'supervisor'=>[
            'column_name'=>'shipment.supervisor',
            'display_name'=>'Supervisor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
        ],
        'eqc'=> [
            'column_name'=>'shipment',
            'display_name'=>'EQC',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'eqc'
        ],
        'photo'=> [
            'column_name'=>'shipment',
            'display_name'=>'Photo',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'photo'
        ],
        'temp'=>[
            'column_name'=>'shipment',
            'display_name'=>'Temp',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'temperature'
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

        $queryBuilder = ShipmentCarton::with('carton','carton.product','shipment')->whereHas('shipment' ,function($q){
            $q->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));});
        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
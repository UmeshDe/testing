<?php
/**
 * Created by PhpStorm.
 * User: accunity
 * Date: 11/10/17
 * Time: 7:13 PM
 */

namespace Modules\Reports\Reports;

use Modules\Process\Entities\TransferCarton;
use Carbon\Carbon;
use PDF;

class TransferReport extends AbstractReport
{
    public $columns = [
        'load_gp_no'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading Gate Pass No',
            'type' => REPORT_RELATION_COLUMN,
             'relation_column' =>'loading_gate_pass_no'
        ],
        'carton_date'=>[
            'column_name'=>'carton',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'carton_date'
        ],
        'variety'=> [
            'column_name'=>'carton.product.fishtype',
            'display_name'=>'Varity',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'type'
        ],
        'vehicle_no' => [
            'column_name'=>'transfer',
            'display_name'=>'Vehicle No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'vehicle_no'
        ],
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Loading Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'bc'=> [
            'column_name'=>'carton.product.buyer',
            'display_name'=>'BC',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'buyer_code'
        ],
        'appr_no'=>[
            'column_name'=>'carton.product.approval',
            'display_name'=>'Approval No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'app_number'
        ],
        'bag_color'=> [
            'column_name'=>'carton.product',
            'display_name'=>'Bag Color',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'bag_color'
        ],
        'carton_type'=> [
            'column_name'=>'carton.cartontype',
            'display_name'=>'PRINTED/PLAIN',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'type'
        ],
        'no_of_cartons'=>[
            'column_name'=>'quantity',
            'display_name'=>'Loading No Of Cartons',
        ],
        'loading_start_time'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading Start Time',
            'format' => REPORT_DATETIME_FORMAT,
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'loading_start_time'
        ],
        'loading_end_time'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading End Time',
            'format' => REPORT_DATETIME_FORMAT,
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'loading_end_time'
        ],
        'loading_supervisor'=> [
            'column_name'=>'transfer.loadingsupervisor',
            'display_name'=>'Loading Supervisor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
        ],
        'loading_sub_loc'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading Sub Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'loadinglocation'
        ],
        'unload_gp_no'=> [
            'column_name'=>'transfer',
            'display_name'=>'Unoading Gate Pass No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloading_gate_pass_no'
        ],
        'unloading_lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Unloading Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'unloading_no_qty'=>[
            'column_name'=>'received_quantity',
            'display_name'=>'Unloading Carton',
        ],
        'unloading_start_time'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading Start Time',
            'format' => REPORT_DATETIME_FORMAT,
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloading_start_time'
        ],
        'unloading_end_time'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading End Time',
            'format' => REPORT_DATETIME_FORMAT,
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloading_end_time'
        ],
        'unloading_supervisor'=> [
            'column_name'=>'transfer.unloadingsupervisor',
            'display_name'=>'Unoading Supervisor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
        ],
        'unloading_sub_loc'=> [
            'column_name'=>'transfer',
            'display_name'=>'Unoading Sub Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloadinglocation'
        ],
        'remark'=>[
            'column_name'=>'transfer',
            'display_name'=>'Remark',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloading_remark'
        ],
    ];

    public function formatCode($product){
        return count($product['product_date']);
    }
    
    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Loading Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____From:' . '____Start Time' .'________Unloading Date' .'______To___________'.'___________Vehicle No:_____'.'____'  ;
        }
        else{
            $this->reportMaster->sub_title = 'Loading From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Loading To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) . '____From:' . '____Start Time' .'________Unloading Date' .'______To___________';
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

//        $this->reportMaster->footer = 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name .' .  Verified by :_________________  ' .'Prepared by:_________________';

        $queryBuilder = TransferCarton::with('transfer','carton','carton.product','carton.product.buyer','carton.cartontype','transfer.loadinglocation','transfer.loadingsupervisor','transfer.unloadinglocation','transfer.unloadingsupervisor','carton.product.fishtype')->whereHas('transfer' ,function($q){
            $q->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));});

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
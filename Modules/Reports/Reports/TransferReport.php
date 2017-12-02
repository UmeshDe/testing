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
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'product_date'=> [
            'column_name'=>'carton.product',
            'display_name'=>'Product Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'product_date'
        ],
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
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'gread'=> [
            'column_name'=>'bagColor',
            'display_name'=>'Gread',
        ],
        'appr_no'=>[
            'column_name'=>'carton.product.approval',
            'display_name'=>'Approval No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'app_number'
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
        'loading_sub_loc'=> [
            'column_name'=>'transfer',
            'display_name'=>'Loading Sub Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'loadinglocation'
        ],
        'loading_sup'=>[
            'column_name'=>'transfer.loadingsupervisor',
            'display_name'=>'Loading Supervisor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
        ],
        'unload_gp_no'=> [
            'column_name'=>'transfer',
            'display_name'=>'Unoading Gate Pass No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloading_gate_pass_no'
        ],
        'unloading_no_qty'=>[
            'column_name'=>'received_quantity',
            'display_name'=>'Unloading Quantity',
        ],
        'unloading_sub_loc'=> [
            'column_name'=>'transfer',
            'display_name'=>'Unoading Sub Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'unloadinglocation'
        ],
        'unloading_sup'=>[
            'column_name'=>'transfer.unloadingsupervisor',
            'display_name'=>'Unloading Supervisor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
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


        $this->reportMaster->sub_title = 'From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name .' .  Verified by :_________________  ' .'Prepared by:_________________';

        $queryBuilder = TransferCarton::with('transfer','carton','carton.product','carton.cartontype','transfer.loadinglocation','transfer.loadingsupervisor','transfer.unloadinglocation','transfer.unloadingsupervisor','carton.product.fishtype')->whereHas('transfer' ,function($q){
            $q->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));});

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
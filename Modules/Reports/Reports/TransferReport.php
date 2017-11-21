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
        'load_gp_no'=> [
            'column_name'=>'transfer.loading_gate_pass_no',
            'display_name'=>'Loading Gate Pass No',
            'type' => REPORT_RELATION_COLUMN
        ],
        'carton_date'=>[
            'column_name'=>'carton.carton_date',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN
        ],
        'variety'=> [
            'column_name'=>'carton.product.variety',
            'display_name'=>'Varity',
            'type' => REPORT_RELATION_COLUMN
        ],
        'lot_no'=>[
            'column_name'=>'carton.product.lot_no',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN
        ],
        'gread'=> [
            'column_name'=>'bagColor',
            'display_name'=>'Gread',
        ],
        'appr_no'=>[
            'column_name'=>'carton.product.approval_no',
            'display_name'=>'Approval No',
            'type' => REPORT_RELATION_COLUMN
        ],
        'carton_type'=> [
            'column_name'=>'carton.cartontype',
            'display_name'=>'CARTONS PRINTED/PLAIN',
            'type' => REPORT_RELATION_COLUMN
        ],
        'no_of_cartons'=>[
            'column_name'=>'quantity',
            'display_name'=>'Loading No Of Cartons',
        ],
        'loading_sub_loc'=> [
            'column_name'=>'transfer.loadinglocation',
            'display_name'=>'Loading Sub Location',
            'type' => REPORT_RELATION_COLUMN
        ],
        'loading_sup'=>[
            'column_name'=>'transfer.loadingsupervisor',
            'display_name'=>'Loading Supervisor',
            'type' => REPORT_RELATION_COLUMN
        ],
        'unload_gp_no'=> [
            'column_name'=>'transfer.unloading_gate_pass_no',
            'display_name'=>'Unoading Gate Pass No',
            'type' => REPORT_RELATION_COLUMN
        ],
        'unloadlot_no'=>[
            'column_name'=>'carton.product.lot_no',
            'display_name'=>'Unloading Lot No',
            'type' => REPORT_RELATION_COLUMN
        ],
        'unloading_sub_loc'=> [
            'column_name'=>'transfer.unloadinglocation',
            'display_name'=>'Unoading Sub Location',
            'type' => REPORT_RELATION_COLUMN
        ],
        'unloading_sup'=>[
            'column_name'=>'transfer.unloadingsupervisor',
            'display_name'=>'Unloading Supervisor',
            'type' => REPORT_RELATION_COLUMN
        ],

        'remark'=>[
            'column_name'=>'transfer.unloading_remark',
            'display_name'=>'Remark',
            'type' => REPORT_RELATION_COLUMN
        ],
    ];
    
    public function setup(){


        $this->reportMaster->sub_title = 'Date: '.Carbon::parse( $this->startDate)->format(PHP_DATE_FORMAT);

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by :'. auth()->user()->first_name." ".auth()->user()->last_name .'   Verified by :_________________  ' ;

        $queryBuilder = TransferCarton::with('transfer','carton','carton.product','carton.cartontype','transfer.loadinglocation','transfer.loadingsupervisor','transfer.unloadinglocation','transfer.unloadingsupervisor');

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
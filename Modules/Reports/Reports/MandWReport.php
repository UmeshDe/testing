<?php
namespace Modules\Reports\Reports;


use Modules\Process\Entities\QualityParameter;
use Carbon\Carbon;
use PDF;

class MandWReport extends AbstractReport
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
        'kind'=> [
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
        'machine_moisture'=> [
            'column_name'=>'machine_moisture',
            'display_name'=>'Machine',
        ],
        'supervisor_moisture'=> [
            'column_name'=>'moisture',
            'display_name'=>'Supervisor',
        ],
        'machine_kamaboko_hw'=> [
            'column_name'=>'machine_kamaboko_hw',
            'display_name'=>'Machine',
        ],
        'kamaboko_hw'=> [
            'column_name'=>'kamaboko_hw',
            'display_name'=>'Supervisor',
        ],
        'remark'=> [
            'column_name'=>'carton.product',
            'display_name'=>'Remark',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'remark'
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

        $this->reportMaster->footer = 'Prepared by:_________________'.'Varified by :_________________  '. 'Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name;

        $queryBuilder = QualityParameter::with('carton','carton.product','user','kinds')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
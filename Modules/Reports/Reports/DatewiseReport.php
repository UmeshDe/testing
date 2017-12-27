<?php

namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\Product;
use PDF;

class DatewiseReport extends AbstractReport
{

//'product_date'=>[
//'column_name'=>'product_date',
//'display_name'=>'Date',
//'format'=>'date',
//'header_style' =>'color:red',
//'row_style'=>'color:green',
//'force_value'=>'1',
//],

    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'product_date'=> [
            'column_name'=>'product_date',
            'display_name'=>'Production Date',
            'format'=> REPORT_DATE_FORMAT,
        ],
        'date'=> [
            'column_name'=>'carton_date',
            'display_name'=>'Carton Date',
            'format'=> REPORT_DATE_FORMAT
        ],
        'variety'=> [
            'column_name'=>'variety',
            'display_name'=>'Varity',
        ],
        'first_lot_no'=>[
            'column_name'=>'lot_no',
            'display_name'=>'1ST Lot No',
        ],
        'last_lot_no' => [
            'column_name'=>'last',
            'display_name'=>'Last Lot No',
            'type' => REPORT_MULRELATION_COLUMN,
            'relation_column' => ''
        ],
        'no_of_lab'=> [
            'column_name' => 'product_slab',
            'display_name' => 'No.Of.Slab',
        ] ,
        'no_of_cartons'=>[
            'column_name'=>'no_of_cartons',
            'display_name'=>'No of Cartons',
        ],
        'Remark'=>[
            'column_name'=>'remark',
            'display_name'=>'Remark',
        ],
    ];
    
    public $date;

    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){
        
        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->date = 'Production Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->date = 'Production From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Production To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name;

        $this->reportMaster->subfooter = $this->sum;

        $last = $this->lastlot;

        $queryBuilder = Product::with('codes','lastlot','variety','bagColor','cartonType')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));

        $this->data = $queryBuilder->get();

        $this->setupDone = true;
    }
}
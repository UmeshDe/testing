<?php

namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\Product;
use Modules\Process\Repositories\ProductRepository;
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
        'cm'=> [
            'column_name'=>'cm',
            'display_name'=>'CM',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'cm'
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
            'display_name'=>'Production Remark',
        ],
    ];
    
    public $date;

    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){

        $this->reportMaster->sub_title_style = 'text-align:left';

        if($this->reportDate == 0)
        {
            if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
            {
                $this->date = 'Production Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
            }
            else{
                $this->date = 'Production From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Production To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
            }

            $queryBuilder = Product::with('codes','lastlot','variety','bagColor','cartonType')->whereDate('product_date' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('product_date' ,'<=',$this->endDate->format('Y-m-d'));
            $this->sum = app(ProductRepository::class)->allWithBuilder()
                ->whereDate('product_date' , '>=' ,  $this->startDate)
                ->whereDate('product_date' , '<=' ,  $this->endDate)
                ->sum('no_of_cartons');

            $this->reportMaster->subfooter = $this->sum;

        }
        elseif ($this->reportDate == 1)
        {
            if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
            {
                $this->date = 'Carton Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
            }
            else{
                $this->date = 'Carton From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Carton To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
            }

            $queryBuilder = Product::with('codes','lastlot','variety','bagColor','cartonType')->whereDate('carton_date' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('carton_date' ,'<=',$this->endDate->format('Y-m-d'));
            $this->sum = app(ProductRepository::class)->allWithBuilder()
                ->whereDate('carton_date' , '>=' ,  $this->startDate)
                ->whereDate('carton_date' , '<=' ,  $this->endDate)
                ->sum('no_of_cartons');

            $this->reportMaster->subfooter = $this->sum;
        }

        $this->reportMaster->footer = 'Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name . ' , ' .'Date & Time :' . Carbon::now()->format(PHP_DATE_TIME_FORMAT) ;


        $last = $this->lastlot;
        $this->data = $queryBuilder->get();

        $this->setupDone = true;
    }
}
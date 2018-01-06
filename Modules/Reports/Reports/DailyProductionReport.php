<?php

namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\Product;
use Modules\Process\Repositories\ProductRepository;
use PDF;

class DailyProductionReport extends AbstractReport
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
        'date'=> [
            'column_name'=>'product_date',
            'display_name'=>'Production Date',
            'format'=> REPORT_DATE_FORMAT
        ],
        'carton_date'=> [
            'column_name'=>'carton_date',
            'display_name'=>'Carton Date',
            'format'=> REPORT_DATE_FORMAT,
        ],
        'approval_no'=>[
            'column_name'=>'approval',
            'display_name'=>'EIA No',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'app_number'
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
        'lot_no'=>[
            'column_name'=>'lot_no',
            'display_name'=>'Lot No',
        ],
        'no_of_lab'=> [
           'column_name' => 'product_slab',
           'display_name' => 'No.Of.Slab',
        ] ,
        'bag_color'=> [
            'column_name'=>'bagColor',
            'display_name'=>'Bag Color',
        ],
        'po_no'=>[
            'column_name'=>'po_no',
            'display_name'=>'PO NO',
        ],
        'fm' => [
            'column_name'=>'fm',
            'display_name'=>'FM',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'fr' => [
            'column_name'=>'fr',
            'display_name'=>'FR',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'd' => [
            'column_name'=>'d',
            'display_name'=>'D',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        's' => [
            'column_name'=>'s',
            'display_name'=>'S',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'a' => [
            'column_name'=>'a',
            'display_name'=>'A',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'c' => [
            'column_name'=>'c',
            'display_name'=>'C',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'p' => [
            'column_name'=>'p',
            'display_name'=>'P',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'b' => [
            'column_name'=>'b',
            'display_name'=>'B',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'm' => [
            'column_name'=>'m',
            'display_name'=>'M',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'w' => [
            'column_name'=>'w',
            'display_name'=>'W',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'q' => [
            'column_name'=>'Q',
            'display_name'=>'Q',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'sc' => [
            'column_name'=>'sc',
            'display_name'=>'SC',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'lc' => [
            'column_name'=>'lc',
            'display_name'=>'LC',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'code'
        ],
        'bc' =>[
            'column_name'=>'buyer',
            'display_name'=>'Buyer Code',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'buyer_code'
        ],
        'no_of_cartons'=>[
            'column_name'=>'no_of_cartons',
            'display_name'=>'No of Cartons',
        ],
        'Remark'=>[
            'column_name'=>'remark',
            'display_name'=>'Production Remark',
        ],
        'production_done'=>[
            'column_name'=>'user',
            'display_name'=> 'Production Done By',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
        ],
    ];
    
    public $date;


    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){


        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = ' Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name .' , ' .'Date & Time :' . Carbon::now()->format(PHP_DATE_TIME_FORMAT) ;


        if($this->reportDate == 0)
        {
            if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
            {
                $this->date = 'Production Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
            }
            else{
                $this->date = 'Production From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Production To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
            }
            $queryBuilder = Product::with('user','buyer','cm','variety','bagColor','cartonType','fm','fr','d','s','a','c','p','b','m','w','q','sc','lc')->whereDate('product_date' , '>=' , $this->startDate)->whereDate('product_date' ,'<=',$this->endDate)->orderBy('lot_no');
            $this->sum = app(ProductRepository::class)->allWithBuilder()
                ->whereDate('product_date' , '>=' ,  $this->startDate)
                ->whereDate('product_date' , '<=' ,  $this->endDate)
                ->sum('no_of_cartons');

            $this->reportMaster->subfooter = $this->sum;

        }
        elseif ($this->reportDate == 1){
            if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
            {
                $this->date = 'Carton Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
            }
            else{
                $this->date = 'Carton From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Carton To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
            }
            $queryBuilder = Product::with('user','buyer','cm','variety','bagColor','cartonType','fm','fr','d','s','a','c','p','b','m','w','q','sc','lc')->whereDate('carton_date' , '>=' , $this->startDate)->whereDate('carton_date' ,'<=',$this->endDate)->orderBy('lot_no');
            $this->sum = app(ProductRepository::class)->allWithBuilder()
                ->whereDate('carton_date' , '>=' ,  $this->startDate)
                ->whereDate('carton_date' , '<=' ,  $this->endDate)
                ->sum('no_of_cartons');
            $this->reportMaster->subfooter = $this->sum;
        }
        else{
            return "Please Apply Filter";
        }


        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
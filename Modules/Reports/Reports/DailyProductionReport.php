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
            'column_name'=>'carton',
            'display_name'=>'Carton Date',
            'format'=> REPORT_DATE_FORMAT,
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'carton_date'
        ],
        'approval_no'=>[
            'column_name'=>'approval',
            'display_name'=>'Approval No',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'app_number'
        ],
        'variety'=> [
            'column_name'=>'variety',
            'display_name'=>'Varity',
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
//        'code' =>[
//            'column_name'=>'codes',
//            'display_name'=>'Code No',
//            'type'=>REPORT_RELATION_COLUMN,
//            'function' => MODEL_ATTRIBUTE_AS_STRING,
//            'relation_column' =>'code'
//        ],
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
            'display_name'=>'Remark',
        ],
        'production_done'=>[
            'column_name'=>'user',
            'display_name'=> 'Production Done By',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'first_name'
        ],
    ];


    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Production Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->reportMaster->sub_title = 'Production From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Production To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = ' Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name;
        
        $this->reportMaster->subfooter = $this->sum;

        $queryBuilder = Product::with('user','buyer','variety','bagColor','cartonType','fm','fr','d','s','a','c','p','b','m','w','q','sc','lc')->whereDate('created_at' , '>=' , $this->startDate)->whereDate('created_at' ,'<=',$this->endDate);

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
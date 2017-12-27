<?php

namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\Carton;
use PDF;

class DailyPackingReport extends AbstractReport
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
            'column_name'=>'product',
            'display_name'=>'Production Date',
            'type'=>REPORT_RELATION_COLUMN,
            'format'=> REPORT_DATE_FORMAT,
            'relation_column' =>'product_date'
        ],
        'carton_date'=> [
            'column_name'=>'carton_date',
            'format'=> REPORT_DATE_FORMAT,
            'display_name'=>'Carton Date',
        ],
//        'approval_no'=>[
//            'column_name'=>'product.approval',
//            'display_name'=>'Approval No',
//            'type'=>REPORT_RELATION_COLUMN,
//            'relation_column' =>'app_number'
//        ],
        'variety'=> [
            'column_name'=>'product',
            'display_name'=>'Varity',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'variety'
        ],
        'lot_no'=>[
            'column_name'=>'product',
            'display_name'=>'Lot No',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'lot_no'
        ],
        'bag_color'=> [
            'column_name'=>'product',
            'display_name'=>'Bag Color',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'bagColor'
        ],
        'production_slab'=>[
            'column_name'=>'product',
            'display_name'=>'Production slab',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'product_slab'
        ],
        'loose' => [
            'column_name'=>'product',
            'display_name'=>'Loose',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'loose'
        ],
        'rejection_slab'=> [
            'column_name'=>'product',
            'display_name'=>'Rejected Slab',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'rejected',
            'default_value' => '0'
        ],
        'human_error' => [
            'column_name' => 'product',
            'display_name' => 'Human Error',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'human_error_slab',
        ],
        'no_of_cartons'=>[
            'column_name'=>'product',
            'display_name'=>'No of Cartons',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'no_of_cartons',
        ],
        'diff_in_kg'=>[
            'column_name'=>'product',
            'display_name'=>'Diff.In.Kg',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'diff_in_kg',
        ],
        'carton_type'=> [
            'column_name'=>'product',
            'display_name'=>'Carton Type',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'cartonType',
        ],
        'po_no'=>[
            'column_name'=>'product',
            'display_name'=>'PO NO',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'po_no',
        ],
        'fm' => [
            'column_name'=>'product',
            'display_name'=>'FM',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'fm'
        ],
        'fr' => [
            'column_name'=>'product',
            'display_name'=>'FR',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'fr'
        ],
        'd' => [
            'column_name'=>'product',
            'display_name'=>'D',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'d'
        ],
        's' => [
            'column_name'=>'product',
            'display_name'=>'S',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'s'
        ],
        'a' => [
            'column_name'=>'product',
            'display_name'=>'A',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'a'
        ],
        'c' => [
            'column_name'=>'product',
            'display_name'=>'C',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'c'
        ],
        'p' => [
            'column_name'=>'product',
            'display_name'=>'P',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'p'
        ],
        'b' => [
            'column_name'=>'product',
            'display_name'=>'B',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'b'
        ],
        'm' => [
            'column_name'=>'product',
            'display_name'=>'M',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'m'
        ],
        'w' => [
            'column_name'=>'product',
            'display_name'=>'W',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'w'
        ],
        'q' => [
            'column_name'=>'product',
            'display_name'=>'Q',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'q'
        ],
        'sc' => [
            'column_name'=>'product',
            'display_name'=>'SC',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'sc'
        ],
        'lc' => [
            'column_name'=>'product',
            'display_name'=>'LC',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'lc'
        ],
        'location'=>[
            'column_name'=>'product',
            'display_name'=>'Location',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'location'
        ],
        'Remark'=>[
            'column_name'=>'product',
            'display_name'=>'Remark',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'remark'
        ],
        'packing_done'=>[
            'column_name'=>'product.users',
            'display_name'=>'Packing Done By',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' => 'first_name'
        ],
    ];
    
    public $date;

    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->date = 'Carton Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->date = 'Carton From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Carton To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name;

        $queryBuilder = Carton::with('product','product.users','product.approval','product.variety','product.bagColor','product.cartonType','product.fm','product.fr','product.d','product.s','product.a','product.c','product.p','product.b','product.m','product.w','product.q','product.sc','product.lc')->whereDate('carton_date' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('carton_date' ,'<=',$this->endDate->format('Y-m-d'));

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
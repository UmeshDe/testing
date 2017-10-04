<?php

namespace Modules\Reports\Reports;


use Modules\Process\Entities\Product;
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
            'column_name'=>'product_date',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'date'=> [
            'column_name'=>'product_date',
            'display_name'=>'Date',
            'format'=> REPORT_DATE_FORMAT
        ],
        'approval_no'=>[
            'column_name'=>'approval_no',
            'display_name'=>'Approval No',
        ],
        'variety'=> [
            'column_name'=>'variety',
            'display_name'=>'Varity',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'type'

        ],
        'lot_no'=>[
            'column_name'=>'lot_no',
            'display_name'=>'Lot No',
        ],
        'bag_color'=> [
            'column_name'=>'bagColor',
            'display_name'=>'Bag Color',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'color'
        ],
        'production_slab'=>[
            'column_name'=>'product_slab',
            'display_name'=>'Production slab',
        ],
        'rejection_slab'=> [
            'column_name'=>'rejected',
            'display_name'=>'Rejected Slab',
            'default_value' => '0'
        ],
        'no_of_cartons'=>[
            'column_name'=>'no_of_cartons',
            'display_name'=>'No of Cartons',
        ],
        'carton_type'=> [
            'column_name'=>'cartonType',
            'display_name'=>'Carton Type',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'type'
        ],
        'po_no'=>[
            'column_name'=>'po_no',
            'display_name'=>'PO NO',
        ],
        'code' =>[
            'column_name'=>'codes',
            'display_name'=>'Code No',
            'type'=>REPORT_RELATION_COLUMN,
            'function' => MODEL_ATTRIBUTE_AS_STRING,
            'relation_column' =>'code'
        ],
        'location'=>[
            'column_name'=>'location',
            'display_name'=>'Location',
        ],
        'Remark'=>[
            'column_name'=>'remark',
            'display_name'=>'Remark',
        ]
    ];


    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){

        // Report title
        $this->title = 'Daily Production Report';

        $this->name = 'daily_production_report';

        $this->footer = 'Prepared by :'. auth()->user()->first_name." ".auth()->user()->last_name .'   Verified by :_________________  ' ;

        // For displaying filters description on header
        $this->meta = [
            'Duration' => $this->startDate . ' To ' . $this->endDate,
        ];

        // Do some querying..
        //$queryBuilder = Product::select('*')->with('codes','variety')->whereBetween('product_date', [$this->startDate, $this->endDate]);
        $queryBuilder = Product::with('codes','variety','bagColor','cartonType');

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
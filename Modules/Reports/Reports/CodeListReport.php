<?php

namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\ShipmentCarton;
use PDF;

class CodeListReport extends AbstractReport
{

    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'vehicle_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Vehicle No:',
            'type'=> REPORT_RELATION_COLUMN,
            'relation_column' =>'vehicle_no'
        ],
        'container_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Container No',
            'type'=> REPORT_RELATION_COLUMN,
            'relation_column' =>'container_no'
        ],
        'carton_date'=> [
            'column_name'=>'carton',
            'display_name'=>'Carton Date',
            'format'=> REPORT_DATE_FORMAT,
            'type'=> REPORT_RELATION_COLUMN,
            'relation_column' =>'carton_date'
        ],
        'quantity' =>[
            'column_name'=>'quantity',
            'display_name'=>'Quantity',
        ],
    ];


    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){


        $this->reportMaster->sub_title = 'Date: '.Carbon::parse( $this->startDate)->format(PHP_DATE_FORMAT);

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by :'. auth()->user()->first_name." ".auth()->user()->last_name .'   Verified by :_________________  ' ;

        $queryBuilder = ShipmentCarton::with('shipment','carton');

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
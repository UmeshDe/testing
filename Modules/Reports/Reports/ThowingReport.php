<?php

namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\Throwing;
use PDF;

class ThowingReport extends AbstractReport
{

    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'carton_date'=>[
            'column_name'=>'carton_date',
            'display_name'=>'Thowing Date',
        ],
        'throwing_input'=>[
            'column_name'=>'throwing_input',
            'display_name'=>'Thowing Input',
        ],
        'throwing_input_bags'=>[
            'column_name'=>'throwing_input_bags',
            'display_name'=>'Thowing Input Bags',
        ],
        'throwing_output_bags'=>[
            'column_name'=>'throwing_output_bags',
            'display_name'=>'Thowing Output Bags',
        ],
        'throwing_output'=>[
            'column_name'=>'throwing_output',
            'display_name'=>'Thowing Output',
        ],
    ];


    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){


        $this->reportMaster->sub_title = 'Date: '.Carbon::parse( $this->startDate)->format(PHP_DATE_FORMAT);

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by :'. auth()->user()->first_name." ".auth()->user()->last_name .'   Verified by :_________________  ' ;

        $queryBuilder = Throwing::with('carton');

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
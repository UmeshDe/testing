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
        't_date'=>[
            'column_name'=>'carton_date',
            'format' => REPORT_DATE_FORMAT,
            'display_name'=>'Thowing',
        ],
        'location' => [
            'column_name'=>'location',
            'display_name'=>'Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'location'
        ],
        'variety'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Variety',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'fishtype'
        ],
        'thowing_start_time'=>[
            'column_name'=>'thowing_start_time',
            'format' => REPORT_DATETIME_FORMAT,
            'display_name'=> 'Start Time',
        ],
        'thowing_end_time'=>[
            'column_name'=>'thowing_end_time',
            'format' => REPORT_DATETIME_FORMAT,
            'display_name'=>'End Time',
        ],
        'Lot_no'=>[
            'column_name'=>'throwing_input',
            'display_name'=>'Lot No',
        ],
        'bag_color'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Bag color',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'bagColor'
        ],
        'throwing_input'=>[
            'column_name'=>'throwing_input',
            'display_name'=>'No.Of.Cartons',
        ],
        'grade'=>[
            'column_name'=>'carton.qualitycheck.grades',
            'display_name'=>'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'grade'
        ],
        'remark'=>[
            'column_name'=>'comment',
            'display_name'=>'Remark',
        ],
        'thowing_supervisor'=>[
            'column_name'=>'supervisor',
            'display_name'=>'Supervisor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'first_name'
        ],
        'thowing_done_by'=>[
            'column_name'=>'user',
            'display_name'=>'Thowing Done By',
            'type' => REPORT_RELATION_COLUMN,
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
            $this->date = 'Thowing Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->date = 'Thowing From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Thowing  To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT)  ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

//        $this->reportMaster->footer = 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name .' .  Verified by :_________________  ' .'Prepared by:_________________';
//
        $queryBuilder = Throwing::with('carton','carton.qualitycheck','carton.qualitycheck.grades','location','carton.product.fishtype')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
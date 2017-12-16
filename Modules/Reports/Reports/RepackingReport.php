<?php
namespace Modules\Reports\Reports;

use Modules\Process\Entities\Repack;
use Carbon\Carbon;
use PDF;

class RepackingReport extends AbstractReport
{
    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'vehicle_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Variety',
        ],
        'date'=>[
            'column_name'=>'date',
            'display_name'=>'Date',
        ],
        'lot_no'=> [
            'column_name'=>'shipment',
            'display_name'=>'Lot No',
        ],
        'bag_color'=> [
            'column_name'=>'shipment',
            'display_name'=>'Bag Color',
        ],
        'no_of_cartons'=> [
            'column_name'=>'shipment',
            'display_name'=>'No.Of.Cartons',
        ],
        'repacked_spp' => [
            'column_name'=>'shipment',
            'display_name'=>'Repacke SPP',
        ],
        'repacked_date' => [
            'column_name'=>'shipment',
            'display_name'=>'Repacke Date',
        ],
        'repacked_lotno' => [
            'column_name'=>'shipment',
            'display_name'=>'Repacke Lot No',
        ],
        'repacked_bagcolor' => [
            'column_name'=>'shipment',
            'display_name'=>'Repacke Bag Color',
        ],
        'repacked_cartons' => [
            'column_name'=>'shipment',
            'display_name'=>'Repacke Cartons',
        ],
        'repacked_grade' => [
            'column_name'=>'shipment',
            'display_name'=>'Repacke Grade',
        ],
        'remark' => [
            'column_name'=>'shipment',
            'display_name'=>'Remark',
        ],
    ];


    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->reportMaster->sub_title = 'From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by :_________________'.'   Verified by :_________________  '. 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name ;

        $queryBuilder = Repack::with('carton')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));
        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
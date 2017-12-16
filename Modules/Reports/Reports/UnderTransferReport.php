<?php
/**
 * Created by PhpStorm.
 * User: accunity
 * Date: 11/10/17
 * Time: 7:13 PM
 */

namespace Modules\Reports\Reports;

use Modules\Process\Entities\CartonLocation;
use Carbon\Carbon;
use PDF;

class UnderTransferReport extends AbstractReport
{
    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'location_id' => [
            'column_name'=>'location',
            'display_name'=>'Loading Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'location'
        ],
        'product_date'=> [
            'column_name'=>'carton.product',
            'display_name'=>'Product Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'product_date'
        ],
        'carton_date'=>[
            'column_name'=>'carton',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'carton_date'
        ],
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'available_quantity'=>[
            'column_name'=>'available_quantity',
            'display_name'=>'Available Quantity',
        ],
        'transit'=>[
            'column_name'=>'transit',
            'display_name'=>'No.Of.Cartons In Transit',
        ],
    ];

    public function formatCode($product){
        return count($product['product_date']);
    }

    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Loading Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->reportMaster->sub_title = 'From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name .' .  Verified by :_________________  ' .'Prepared by:_________________';

        $queryBuilder = CartonLocation::with('carton','location','carton.product','carton.cartontype','carton.product.fishtype')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }

}
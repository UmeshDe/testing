<?php
namespace Modules\Reports\Reports;


use Illuminate\Support\Facades\DB;
use Modules\Process\Entities\CartonLocation;
use Modules\Process\Entities\Shipment;
use Modules\Process\Entities\ShipmentCarton;
use Carbon\Carbon;
use Modules\Process\Repositories\CartonLocationRepository;
use PDF;

class PowiseShipmentReport extends AbstractReport
{
    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'product_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Production Date',
            'format' => REPORT_DATE_FORMAT,
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'product_date'
        ],
        'carton_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Carton Date',
            'format' => REPORT_DATE_FORMAT,
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'carton_date'
        ],
        'eia_no'=> [
            'column_name'=>'carton.product.approval',
            'display_name'=>'EIA No.',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'app_number'
        ],
        'variety'=> [
            'column_name'=>'carton.product.fishtype',
            'display_name'=>'Variety',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'type'
        ],
        'cm'=> [
            'column_name'=>'carton.product.cm',
            'display_name'=>'CM',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'cm'
        ],
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'qcr_pageno'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'QCRPage No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'qcr_pageno'
        ],
        'total_cartons'=> [
            'column_name'=>'carton',
            'display_name'=>'Total Cartons',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'no_of_cartons'
        ],
        'grade'=>[
            'column_name'=>'carton.qualitycheck.grades',
            'display_name'=>'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'grade'
        ],
        'ic'=>[
            'column_name'=>'carton.qualitycheck.ic',
            'display_name'=>'IC',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'internal_code'
        ],
        'moisture'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Moisture',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'moisture'
        ],
        'standar_wf'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'W',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'work_force'
        ],
        'standard_l'=>[
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'L',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'length'
        ],
        'standard_gl'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'JS',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'gel_strength'
        ],
        'kamaboko_hw'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Kamaboko HW',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'kamaboko_hw'
        ],
        'contam'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'Contam',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'contam'
        ],
        'ph'=> [
            'column_name'=>'carton.qualitycheck',
            'display_name'=>'PH',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'ph'
        ],
        'shipped_qty'=>[
            'column_name'=>'quantity',
            'display_name'=>'Shipped QTY',
        ],
        'container_no'=>[
            'column_name'=>'shipment',
            'display_name'=>'Container No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'container_no'
        ],
    ];

    public $pos;
    public $containerno;


    public function setup(){


        $this->reportMaster->sub_title_style = 'text-align:left';


//        $queryBuilder = ShipmentCarton::with('carton','carton.product','carton.product.fishtype','shipment')->whereHas('shipment' ,function($q){
//            $q->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));});


//        if($this->po != null || $this->po != "")
//        {
//        $this->containerno = $this->container;
        $this->pos = $this->po;


            $queryBuilder = ShipmentCarton::with('carton','carton.product','carton.product.fishtype','shipment')->whereHas('carton.product' ,function($q){
                $q->whereIn('po_no', $this->po );
            });

            $this->reportMaster->subfooter = DB::table("process__shipmentcartons")
                ->join('process__shipments','process__shipments.id','=','process__shipmentcartons.shipment_id')
                ->join('process__cartons','process__shipmentcartons.carton_id','=','process__cartons.id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__shipmentcartons.quantity) as total'))
                ->whereIn('process__products.po_no',$this->po)
//                ->whereIn('process__shipments.container_no',$this->container)
                ->get();
//        }
////        else
//        {
//            $queryBuilder = ShipmentCarton::with('carton','carton.product','carton.product.fishtype','shipment')->whereHas('shipment' ,function($q){
//                $q->where('container_no', $this->container);
//            });
//
//            $this->reportMaster->subfooter = DB::table("process__shipmentcartons")
//                ->join('process__shipments','process__shipments.id','=','process__shipmentcartons.shipment_id')
//                ->join('process__cartons','process__shipmentcartons.carton_id','=','process__cartons.id')
//                ->join('process__products','process__cartons.product_id','=','process__products.id')
//                ->select(DB::raw('SUM(process__shipmentcartons.quantity) as total'))
//                ->where('process__shipments.container_no',$this->container)
//                ->get();
//        }

        $this->reportMaster->footer = ' Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name .' , ' .'Date & Time :' . Carbon::now()->format(PHP_DATE_TIME_FORMAT) ;
        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}

<?php
namespace Modules\Reports\Reports;


use Illuminate\Support\Facades\DB;
use Modules\Process\Entities\QualityParameter;
use Modules\Process\Entities\Shipment;
use Modules\Process\Entities\ShipmentCarton;
use Carbon\Carbon;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\ProductRepository;
use PDF;

class GradewiseStockReport extends AbstractReport
{
    public $columns = [
        'sr_no'=>[
            'column_name'=>'sr_no',
            'display_name'=>'Sr No',
            'type'=> REPORT_ROWNO_COLUMN
        ],
        'ic'=>[
            'column_name'=> 'ic',
            'display_name'=> 'IC',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'internal_code'
        ],
        'product_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Production Date',
            'type' => REPORT_RELATION_COLUMN,
            'format'=> REPORT_DATE_FORMAT,
            'relation_column' => 'product_date'
        ],
        'carton_date'=>[
            'column_name'=>'carton',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'format'=> REPORT_DATE_FORMAT,
            'relation_column' => 'carton_date'
        ],
        'lot_no' => [
            'column_name'=>'carton.product',
            'display_name'=>'LOT No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'name' => [
            'column_name'=>'carton.location',
            'display_name'=>'Name',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'name'
        ],
        'location' => [
            'column_name'=>'carton.location',
            'display_name'=>'Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'location'
        ],
        'sublocation' => [
            'column_name'=>'carton.location',
            'display_name'=> 'Sublocation',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'sublocation'
        ],
        'landmark' => [
            'column_name'=>'carton.location',
            'display_name'=> 'Landmark',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'landmark'
        ],
        'street' => [
            'column_name'=>'carton.location',
            'display_name'=> 'Street',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'street'
        ],
        'qty' => [
            'column_name'=>'carton',
            'display_name'=> 'No.Of.Cartons',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'no_of_cartons'
        ],
    ];

    public $total;

    public $variety;

    public function setup(){

        $this->reportMaster->sub_title_style = 'text-align:left';
        $this->reportMaster->footer = 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name ;
        $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->whereHas('carton.product', function ($q) {
            $q->where('fish_type', $this->variety);
        });

        $this->total = DB::table("process__qualityparameters")
            ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
            ->join('process__products','process__cartons.product_id','=','process__products.id')
            ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
            ->where('process__products.fish_type',$this->variety)
            ->get();

       
        $this->data = $queryBuilder->get();
        $this->setupDone = true;
    }
}
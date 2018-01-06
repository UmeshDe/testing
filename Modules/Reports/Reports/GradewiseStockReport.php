<?php
namespace Modules\Reports\Reports;


use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\BuyercodeRepository;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Admin\Repositories\InternalcodeRepository;
use Modules\Admin\Repositories\LocationRepository;
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
            'display_name'=>'City',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'name'
        ],
        'location' => [
            'column_name'=>'carton.location',
            'display_name'=>'Place',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'location'
        ],
        'sublocation' => [
            'column_name'=>'carton.location',
            'display_name'=> 'Chamber/Zone/Floor',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'sublocation'
        ],
        'landmark' => [
            'column_name'=>'carton.location',
            'display_name'=> 'Location',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'landmark'
        ],
        'street' => [
            'column_name'=>'carton.location',
            'display_name'=> 'Pallet No',
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
        $this->reportMaster->footer = ' Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name .' , ' .'Date & Time :' . Carbon::now()->format(PHP_DATE_TIME_FORMAT) ;



        //Repositories
        $fishtype = app(FishTypeRepository::class)->find($this->variety);
        $grade = app(GradeRepository::class)->find($this->grade);
        $buyer= app(BuyercodeRepository::class)->find($this->buyer);
        $ic = app(InternalcodeRepository::class)->find($this->ic);
        $location = app(LocationRepository::class)->find($this->place);


        if($this->variety != null || $this->variety != "")
        {
            $this->reportMaster->sub_title = 'Variety : '.$fishtype->type;

            $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->whereHas('carton.product', function ($q) {
                $q->where('fish_type', $this->variety);
            });

            $this->total = DB::table("process__qualityparameters")
                ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
                ->where('process__products.fish_type',$this->variety)
                ->get();
            
        }
        else if($this->po != null || $this->po != "")
        {
            $this->reportMaster->sub_title = 'PO No. : '.$this->po;

            $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->whereHas('carton.product', function ($q) {
                $q->where('po_no', $this->po);
            });

            $this->total = DB::table("process__qualityparameters")
                ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
                ->where('process__products.po_no',$this->po)
                ->get();
            
        }
        else if($this->grade != null || $this->grade != "")
        {
            $this->reportMaster->sub_title = 'PO No. : '.$grade->grade;
            $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->where('grade_id',$this->grade);
            $this->total = DB::table("process__qualityparameters")
                ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
                ->where('process__qualityparameters.grade_id',$this->grade)
                ->get();
        }
        else if($this->buyer != null || $this->buyer != "")
        {
            $this->reportMaster->sub_title = 'Buyer Code. : '.$buyer->buyer_code;
            $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->whereHas('carton.product', function ($q) {
                $q->where('buyercode_id', $this->buyer);
            });
            $this->total = DB::table("process__qualityparameters")
                ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
                ->where('process__products.buyercode_id',$this->buyer)
                ->get();
        }
        else if($this->ic != null || $this->ic != "")
        {
            $this->reportMaster->sub_title = 'IC. : '.$ic->internal_code;
            $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->where('ic_id',$this->ic);
            $this->total = DB::table("process__qualityparameters")
                ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
                ->where('process__qualityparameters.ic_id',$this->ic)
                ->get();
        }
        else if($this->place != null || $this->place != "")
        {
            $this->reportMaster->sub_title = 'Place. : '.$location->location;

            $queryBuilder = QualityParameter::with('carton', 'carton.cartonlocation', 'carton.product', 'carton.product.codes', 'user')->whereHas('carton', function ($q) {
                $q->where('location_id', $this->place);
            });
            $this->total = DB::table("process__qualityparameters")
                ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
                ->join('process__products','process__cartons.product_id','=','process__products.id')
                ->select(DB::raw('SUM(process__cartons.no_of_cartons) as total'))
                ->where('process__cartons.location_id',$this->place)
                ->get();
        }
       
        $this->data = $queryBuilder->get();
        $this->setupDone = true;
    }
}
<?php
namespace Modules\Reports\Reports;


use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Process\Entities\Carton;
use Modules\Process\Entities\Shipment;
use Modules\Process\Entities\ShipmentCarton;
use Carbon\Carbon;
use PDF;

class ConsolidatedStockReport extends AbstractReport
{
    public $columns = [];
    public $fishTypes;
    public $gradeSum;
    public $grades;
    public $date;

    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->date = 'Carton Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->date = 'Carton From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Carton To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Printed by :'. auth()->user()->first_name." ".auth()->user()->last_name ;

        
        $this->fishTypes = app(FishTypeRepository::class)->all();
        $this->grades = app(GradeRepository::class)->all();
        $this->gradeSum =  DB::table("process__qualityparameters")
            ->join('process__cartons','process__cartons.id','=','process__qualityparameters.carton_id')
            ->join('process__products','process__cartons.product_id','=','process__products.id')
            ->select('grade_id','fish_type',DB::raw('SUM(process__cartons.no_of_cartons) as total_sales'))
            ->groupBy('grade_id','fish_type')
            ->whereDate('process__cartons.carton_date' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('process__cartons.carton_date' ,'<=',$this->endDate->format('Y-m-d'))
            ->get();


//        $queryBuilder = Carton::with('qualitycheck')->whereDate('carton_date' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('carton_date' ,'<=',$this->endDate->format('Y-m-d'));
//
//        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
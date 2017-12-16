<?php
namespace Modules\Reports\Reports;


use Hamcrest\Text\SubstringMatcher;
use Illuminate\Support\Facades\DB;
use Modules\Process\Entities\QualityParameter;
use Carbon\Carbon;
use Modules\Process\Repositories\CartonLocationRepository;
use PDF;

class SurimiProductionQualityStockReport extends AbstractReport
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
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'product_date'
        ],
        'carton_date'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'carton_date'
        ],
        'variety'=> [
            'column_name'=>'kinds',
            'display_name'=>'Variety',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'kind'
        ],
        'lot_no'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'lot_no'
        ],
        'no_of_slab'=>[
            'column_name'=>'carton.product',
            'display_name'=>'no_of_slab',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'product_slab'
        ],
        'bag_color'=> [
            'column_name'=>'carton.product',
            'display_name'=>'Bag Color',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'bagColor'
        ],
        'po_no'=> [
            'column_name'=>'carton.product',
            'display_name'=>'PO No',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'po_no'
        ],
        'fm' => [
            'column_name'=>'carton.product',
            'display_name'=>'FM',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'fm'
        ],
        'fr' => [
            'column_name'=>'carton.product',
            'display_name'=>'FR',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'fr'
        ],
        'd' => [
            'column_name'=>'carton.product',
            'display_name'=>'D',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'d'
        ],
        's' => [
            'column_name'=>'carton.product',
            'display_name'=>'S',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'s'
        ],
        'a' => [
            'column_name'=>'carton.product',
            'display_name'=>'A',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'a'
        ],
        'c' => [
            'column_name'=>'carton.product',
            'display_name'=>'C',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'c'
        ],
        'p' => [
            'column_name'=>'carton.product',
            'display_name'=>'P',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'p'
        ],
        'b' => [
            'column_name'=>'carton.product',
            'display_name'=>'B',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'b'
        ],
        'm' => [
            'column_name'=>'carton.product',
            'display_name'=>'M',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'m'
        ],
        'w' => [
            'column_name'=>'carton.product',
            'display_name'=>'W',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'w'
        ],
        'q' => [
            'column_name'=>'carton.product',
            'display_name'=>'Q',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'q'
        ],
        'sc' => [
            'column_name'=>'carton.product',
            'display_name'=>'SC',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'sc'
        ],
        'lc' => [
            'column_name'=>'carton.product',
            'display_name'=>'LC',
            'type'=>REPORT_RELATION_COLUMN,
            'relation_column' =>'lc'
        ],
        'qcr_pagrno'=>[
            'column_name'=>'qcr_pageno',
            'display_name'=>'QCR PAGE',
        ],
        'inspection_date'=>[
            'column_name'=>'inspection_date',
            'display_name'=>'Inspection Date',
        ],
        'no_of_cartons'=>[
            'column_name'=>'carton.product',
            'display_name'=>'Cartons',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'no_of_cartons'
        ],
        'grade'=>[
            'column_name'=>'grades',
            'display_name'=>'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'grade'
        ],
        'moisture'=> [
            'column_name'=>'moisture',
            'display_name'=>'Moisture',
        ],
        'standar_wf'=> [
            'column_name'=>'work_force',
            'display_name'=>'Work Force',
        ],
        'standard_l'=>[
            'column_name'=>'length',
            'display_name'=>'Length',
        ],
        'standard_gl'=> [
            'column_name'=>'gel_strength',
            'display_name'=>'Gel Strength',
        ],
        'suwari_wf'=>[
            'column_name'=>'suwari_work_force',
            'display_name'=>'20% Work Force',
        ],
        'suwari_l'=> [
            'column_name'=>'suwari_length',
            'display_name'=>'20% Length',
        ],
        'suwari_gl'=>[
            'column_name'=>'gel_strength',
            'display_name'=>'20% Gel Strength',
        ],
        'kamaboko_hw'=> [
            'column_name'=>'kamaboko_hw',
            'display_name'=>'Kamaboko HW',
        ],
        'contam'=> [
            'column_name'=>'contam',
            'display_name'=>'Contam',
        ],
        'ph'=> [
            'column_name'=>'ph',
            'display_name'=>'PH',
        ],
        'balance_qty'=>[
            'column_name'=>'carton.cartonlocation',
            'display_name'=>'Balance Qty',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'available_quantity'
        ],
        'warehouse' => [
            'column_name'=>'carton.product',
            'display_name'=>'Warehouse',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' =>'location'
        ],
    ];


    public function formatCode($codes){
        return count($codes);
    }

    public function setup(){

        if(Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) == Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT))
        {
            $this->reportMaster->sub_title = 'Inspection Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) ;
        }
        else{
            $this->reportMaster->sub_title = 'Inspection From Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT) . '____Inspection To Date:' .Carbon::parse($this->endDate)->format(PHP_DATE_FORMAT) ;
        }

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by:_________________'.'Varified by :_________________  '. 'Printed by :'.  auth()->user()->first_name." ".auth()->user()->last_name;

        $queryBuilder = QualityParameter::with('carton','carton.cartonlocation','carton.product','carton.product.codes','user','kinds')->whereDate('created_at' , '>=' , $this->startDate->format('Y-m-d'))->whereDate('created_at' ,'<=',$this->endDate->format('Y-m-d'));

        $this->reportMaster->subfooter = app(CartonLocationRepository::class)->all()->sum('available_quantity');

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
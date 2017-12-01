<?php
namespace Modules\Reports\Reports;


use Carbon\Carbon;
use Modules\Process\Entities\QualityParameter;
use PDF;


class QualityCertificateReport extends AbstractReport
{
    public $columns = [
        'sr_no' => [
            'column_name' => 'sr_no',
            'display_name' => 'Sr No',
            'type' => REPORT_ROWNO_COLUMN
        ],
        'carton_date' => [
            'column_name' => 'carton',
            'display_name' => 'Carton Date',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'carton_date'
        ],
        'lot_no' => [
            'column_name' => 'carton',
            'display_name' => 'Lot No',
            'type' => REPORT_RELATION_COLUMN,
            'function' => MODEL_ATTRIBUTE_FROM_RELATION,
            'relation_column' => 'lot_no'
        ],
        'C/s' => [
            'column_name' => 'carton',
            'display_name' => 'C/s',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'no_of_cartons'
        ],
        'moisture' => [
            'column_name' => 'moisture',
            'display_name' => 'Moisture',
        ],
        'breaking' => [
            'column_name' => 'breaking',
            'display_name' => 'Breaking',
        ],
        'depth' => [
            'column_name' => 'depth',
            'display_name' => 'Depth',
        ],
        'standard_gl' => [
            'column_name' => 'gel_strength',
            'display_name' => 'Gel Strength',
        ],
        'whiteness' => [
            'column_name' => 'whiteness',
            'display_name' => 'Whiteness',
        ],
        'contam' => [
            'column_name' => 'contam',
            'display_name' => 'Contam',
        ],
        'ph' => [
            'column_name' => 'ph',
            'display_name' => 'PH',
        ],
        'grade' => [
            'column_name' => 'grades',
            'display_name' => 'Grade',
            'type' => REPORT_RELATION_COLUMN,
            'relation_column' => 'grade'
        ],
    ];

    public function setup()
    {

        $this->reportMaster->sub_title = 'Date: ' . Carbon::parse($this->startDate)->format(PHP_DATE_FORMAT);

        $this->reportMaster->sub_title_style = 'text-align:left';

        $this->reportMaster->footer = 'Prepared by :' . auth()->user()->first_name . " " . auth()->user()->last_name . '   Verified by :_________________  ' . 'Printed by :_________________' . "\n" . '  Qualitycheckdone by :_________________';

        $queryBuilder = QualityParameter::with('carton','carton.product', 'user', 'kinds');

        $this->data = $queryBuilder->get();

        $this->setupDone = true;

    }
}
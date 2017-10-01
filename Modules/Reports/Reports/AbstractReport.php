<?php


namespace Modules\Reports\Reports;


class AbstractReport
{
    public $startDate;
    public $endDate;
    public $isExport;
    public $options;

    public $totals = [];
    public $columns = [];
    public $data = [];

    public function __construct($startDate, $endDate, $isExport, $options = false)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->isExport = $isExport;
        $this->options = $options;
    }

    public function run()
    {

    }

    public function results()
    {
        return [
            'columns' => $this->columns,
            'displayData' => $this->data,
            'reportTotals' => $this->totals,
        ];
    }

}
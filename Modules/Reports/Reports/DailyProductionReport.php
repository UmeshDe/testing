<?php

namespace Modules\Reports\Reports;

use Modules\Process\Entities\Product;
use PdfReport;


class DailyProductionReport extends AbstractReport
{

    public $columns = [
        'Date',
        'Approval No.',
        'Variety'
    ];

    public function run(){

        // Report title
        $title = 'Daily Production Report';

        // For displaying filters description on header
        $meta = [
            'Duration' => $this->startDate . ' To ' . $this->endDate,
        ];

        // Do some querying..
        $queryBuilder = Product::select(['id', 'product_date', 'no_of_cartons'])
            ->whereBetween('product_date', [$this->startDate, $this->endDate]);

        // Set Column to be displayed
        $columns = [
            'id' => 'id',
            'Date', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'No of Cartons' => 'no_of_cartons'
        ];

        /*
            Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).

            - of()         : Init the title, meta (filters description to show), query, column (to be shown)
            - editColumn() : To Change column class or manipulate its data for displaying to report
            - editColumns(): Mass edit column
            - showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            - groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
            - limit()      : Limit record to be showed
            - make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        */

        return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); // or download('filename here..') to download pdf
    }
}
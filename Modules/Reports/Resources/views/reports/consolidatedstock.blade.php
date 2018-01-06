@extends('reports::reports.layout.master')

@section('styles')

    <?php
    use Dompdf\FontMetrics;
    ?>
@endsection

@section('content')
    <?php

    $fishtypes = app(\Modules\Admin\Repositories\FishTypeRepository::class);
    ?>

    <table style="margin-top: 5%">
        {{--<thead>--}}
        <tr>
            <td colspan="19" align="center"> {{$report->reportMaster->title}}</td>
        </tr>
        <tr>
            <td colspan="19"
                align="left"> {{$report->reportMaster->sub_title }}</td>
        </tr>
        <tr>
            <td>
                SPP
            </td>
                    @foreach ($report->grades->reverse() as $grade)
                        <td>

                        {{  $grade->grade }}

                        </td>
                    @endforeach
            <td>
                UG
            </td>
            <td>
                Total
            </td>
        </tr>
        {{--</thead>--}}
        <?php
        $i = 0;
            $total = 0;
            $final = 0;
        ?>
        @foreach ($report->fishTypes as $fishtype)
            <?php
            $total = 0;
                $cartons = 0;
                    ?>
            <tr>
                <td>
                    {{ $fishtype->type }}
                </td>
                @foreach ($report->grades->reverse() as $grade)
                    <td>
                        <?php
                        $value = $report->gradeSum->where('grade_id', $grade->id)->where('fish_type', $fishtype->id);
                        if(count($value) >= 1)
                            {
                             foreach ($value as $val)
                                 {
                                     $total += $val->total_sales;
                                     echo $val->total_sales;
                                 }
                            }
                            else{
                            echo "";
                        }
                        ?>
                    </td>
                @endforeach
                <td>
                    <?php
                    $value = $report->ungraded->where('fish_type', $fishtype->id);
                    foreach ($value as $val)
                    {
                        $cartons += $val->total_sales;
                        echo $cartons;
                        }
                        ?>
                </td>
                <td>
                    <?php
                    echo $total;
                    ?>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="17"></td>
            <?php
            foreach($report->gradeSum as $grade)
            {
                $final += $grade->total_sales;
            }
                    ?>
            <td>Total</td>
            <td>
                <?php
                    echo $final;
                ?>
            </td>

        </tr>

    </table>
@endsection

@section('script')


@endsection
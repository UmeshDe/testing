@extends('reports::reports.layout.master')
<?php  ini_set('max_execution_time', -1); ?>

@section('styles')

    <?php
    use Dompdf\FontMetrics;
    ?>
@endsection

@section('content')

    <table class="export-table">
        <thead>
        <tr>
            <td colspan="37" align="center"> {{$report->reportMaster->title}}</td>
        </tr>
        <tr>
            <td colspan="37" align="left"> {{$report->date}}</td>
        </tr>
        <tr>
            <td colspan="28" align="left"> </td>
            <td colspan="3" align="center">STANDARD</td>
            <td colspan="3" align="center">SUWARI</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            @foreach($report->columns as $column)
                <th style="{{isset($column['header_style'])?$column['header_style']:''}}">
                    {{isset($column['display_name'])?$column['display_name']:''}}
                </th>
            @endforeach
        </tr>
        </thead>
        <?php
        $i = 0;
        ?>
        @foreach($report->data as $row)
            <?php $i++;
            ?>
            <tr>
                @foreach($report->columns as $column)
                    <td style="{{isset($column['row_style'])?$column['row_style']:''}}">

                        <?php $value;

                        //Set if value to the given value if the force value is set
                        if(isset($column['force_value'])){
                            $value = $column['force_value'];
                        }
                        else if(isset($column['type'])){
                            //Column type is set and it is a rowid column
                            if($column['type'] === REPORT_ROWNO_COLUMN){
                                $value = $i;
                            }
                            //Column type is set and it is a relation column
                            else if($column['type'] === REPORT_RELATION_COLUMN){

                                //Get the final relation model
                                $modelArray  = explode('.',$column['column_name']);
                                $relationModel = $row;

                                foreach ($modelArray as $subModel){
                                    $relationModel = $relationModel->{$subModel};
                                }

                                //Custom function is set so call custom function
                                if(isset($column['function'])){
                                    $value = $column['function']($relationModel,$column['relation_column']);
                                }
                                else{
                                    $value = isset($relationModel)?$relationModel->{$column['relation_column']}:'';
                                }
                            }
                        }
                        else{
                            $value = $row->{$column['column_name']};
                        }

                        //Format the value of the model
                        if(isset($column['format'])){
                            $value = formatValue($value,$column['format']);
                        }

                        if(!isset($value)){
                            if(isset($column['default_value'])){
                                $value = $column['default_value'];
                            }
                            else{
                                $value = "-";
                            }
                        }
                        ?>
                        {{$value}}
                    </td>
                @endforeach
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <td colspan="23" align="center"></td>
            <td colspan="1"> Total No. Of Cartons</td>
            @foreach($report->reportMaster->subfooter as $total)
            <td>{{$total->total}}</td>
            @endforeach
            <td colspan="12"></td>
        </tr>
        </tfoot>
    </table>
@endsection

@section('script')


@endsection
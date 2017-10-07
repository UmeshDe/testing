@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::qualityparameters.title.qualityparameters') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('process::qualityparameters.title.qualityparameters') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Production Date</th>
                                <th>Lot No</th>
                                <th>Carton Date</th>
                                <th>No.Of Cartons</th>
                                <th>FishType</th>
                                <th>Bag Color</th>
                                <th>Status</th>
                                {{--<th>{{ trans('core::core.table.created at') }}</th>--}}
                                {{--<th data-sortable="false">{{ trans('core::core.table.actions') }}</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($cartons))
                                @foreach($cartons as $carton)

                            <tr>
                                <td>{{isset($carton->product)?\Carbon\Carbon::parse($carton->product->product_date)->format(PHP_DATE_FORMAT) : ''}}</td>
                                <td>{{isset($carton->product)?$carton->product->lot_no : ''}}</td>
                                <td>{{isset($carton->carton_date)?\Carbon\Carbon::parse($carton->carton_date)->format(PHP_DATE_FORMAT) : ''}}</td>
                                <td>{{$carton->no_of_cartons}}</td>
                                <td>{{isset($carton->product->fishtype)?$carton->product->fishtype->type : '' }}</td>
                                <td>{{isset($carton->bagcolor)?$carton->bagcolor->color : ''}}</td>
                                <td>
                                    @if(!isset($carton->qualitycheck))
                                        <a href="{{ route('admin.process.qualityparameter.create', ['id' => $carton->id]) }}" class="btn btn-default btn-danger"><span style="color:white">Pending</span></a>
                                    @elseif($carton->qualitycheckdone )
                                        <a href="{{ route('admin.process.qualityparameter.edit', ['id' => $carton->qualitycheck->id]) }}" class="btn btn-default btn-success"><span style="color:white">Completed</span></a>
                                    @else
                                        <a href="{{ route('admin.process.qualityparameter.edit', ['id' => $carton->qualitycheck->id]) }}" class="btn btn-default btn-info"><span style="color:white">In Progress</span></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('process::qualityparameters.title.create qualityparameter') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.process.qualityparameter.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush

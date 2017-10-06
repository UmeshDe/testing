@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::transfers.title.transfers') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('process::transfers.title.transfers') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.process.transfer.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('process::transfers.button.create transfer') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Vehicle No.</th>
                                <th>Container No.</th>
                                <th>Loading From</th>
                                <th>Unloading To</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($transfers)): ?>
                            <?php foreach ($transfers as $transfer): ?>
                            <tr>
                                <td>{{$transfer->vehicle_no}}</td>
                                <td>{{$transfer->container_no}}</td>
                                <td>{{$transfer->loadinglocation['name'].'-'.$transfer->loadinglocation['location'].'-'.$transfer->loadinglocation['sublocation']}}</td>
                                <td>{{$transfer->unloadinglocation['name'].'-'.$transfer->unloadinglocation['location'].'-'.$transfer->unloadinglocation['sublocation']}}</td>
                                <td>
                                    @if($transfer->status == 0)
                                        <a href="{{ route('admin.process.transfer.create', ['id' => $transfer->id]) }}" id="btn1" class="btn btn-default btn-info"><span style="color:white">Loaded</span></a>
                                    @else
                                        <a href="{{ route('admin.process.transfer.create', ['id' => $transfer->id]) }}" id="btn3" class="btn btn-default btn-success"><span style="color:white">Completed</span></a>
                                    @endif
                                </td>
                                {{--<td>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<a href="{{ route('admin.process.transfer.edit', [$transfer->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>--}}
                                        {{--<button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.process.transfer.destroy', [$transfer->id]) }}"><i class="fa fa-trash"></i></button>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
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
        <dd>{{ trans('process::transfers.title.create transfer') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.process.transfer.create') ?>" }
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

@extends('layouts.master')

@section('content-header')
    <div  class="row">
        <div class="col-md-6">
            <h4>
                {{ trans('process::repacks.title.repacks') }}
            </h4>
        </div>
        <div class="col-md-6">
            <h4>
                <a href="{{ route('admin.process.repack.create') }}" class="btn btn-primary pull-right btn-flat" style="padding: 4px 10px;">
                    <i class="fa fa-pencil"></i> {{ trans('process::repacks.button.create repack') }}
                </a>
            </h4>
        </div>
    </div>
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
                                <th>Carton Date</th>
                                <th>Location</th>
                                <th>Damaged Cartons</th>
                                <th>Repacked Cartons</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($repacks)): ?>
                            <?php foreach ($repacks as $repack): ?>
                            <tr>
                                <td>
                                    {{isset($repack->carton_date)?\Carbon\Carbon::parse($repack->carton_date)->format(PHP_DATE_FORMAT) : '' }}
                                </td>
                                <td>
                                    {{$repack->location}}
                                </td>
                                <td>{{$repack->damaged_cartons}}</td>
                                <td>{{$repack->repacked_cartons}}</td>
                                <td>
                                    <a href="{{ route('admin.process.repack.edit', [$repack->id]) }}">
                                        {{ $repack->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.process.repack.edit', [$repack->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.process.repack.destroy', [$repack->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
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
        <dd>{{ trans('process::repacks.title.create repack') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.process.repack.create') ?>" }
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

@extends('layouts.master')

@section('content-header')
    <div  class="row">
        <div class="col-md-6">
            <h4>    {{ trans('process::throwings.title.throwings') }}  </h4>
        </div>
        <div class="col-md-6">
            <h4>
                <a href="{{ route('admin.process.throwing.create') }}" class="btn btn-primary pull-right btn-flat">
                    <i class="fa fa-pencil"></i> {{ trans('process::throwings.button.create throwing') }}
                </a>
            </h4>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {{--<div class="row">--}}
                {{--<div class="btn-group pull-right" style="margin: 0 15px 15px 0;">--}}
                {{--</div>--}}
            {{--</div>--}}
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
                                <th>Throwing Input</th>
                                <th>Throwing Output</th>
                                <th>Comment</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($throwings)): ?>
                            <?php foreach ($throwings as $throwing): ?>
                            <tr>
                                <td>{{isset($throwing->carton_date)?\Carbon\Carbon::parse($throwing->carton_date)->format(PHP_DATE_FORMAT) : '' }}</td>
                                <td>{{$throwing->throwing_input}}</td>
                                <td>{{$throwing->throwing_output}}</td>
                                <td>{{$throwing->comment}}</td>
                                <td>
                                    <a href="{{ route('admin.process.throwing.edit', [$throwing->id]) }}">
                                        {{ $throwing->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.process.throwing.edit', [$throwing->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.process.throwing.destroy', [$throwing->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
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
        <dd>{{ trans('process::throwings.title.create throwing') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.process.throwing.create') ?>" }
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

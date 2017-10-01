@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('reports::reportmasters.title.reportmasters') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('reports::reportmasters.title.reportmasters') }}</li>
    </ol>
@stop

@push('css-stack')

@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($reportmasters)): ?>
                        <?php foreach ($reportmasters as $reportmaster): ?>
                        <tr>
                            <td>
                                <a href="{{ route('admin.reports.reportmaster.edit', [$reportmaster->id]) }}">
                                    {{ $reportmaster->created_at }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.reports.reportlog.edit', [$reportmaster->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.reports.reportlog.destroy', [$reportmaster->id]) }}"><i class="fa fa-trash"></i></button>
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
        <dd>{{ trans('reports::reportmasters.title.create reportmaster') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.reports.reportmaster.create') ?>" }
                ]
            });

        });
    </script>
    <?php $locale = locale(); ?>
@endpush

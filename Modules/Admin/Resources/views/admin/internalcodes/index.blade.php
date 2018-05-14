@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::internalcodes.title.internalcodes') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::internalcodes.title.internalcodes') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="internalcode-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Internal Code</th>
                                <th>Grades</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($internalcodes)): ?>
                            <?php foreach ($internalcodes as $internalcode): ?>
                            <tr>
                                <td>{{$internalcode->internal_code}}</td>
                                <td>{{$internalcode->description}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.internalcode.edit', [$internalcode->id]) }}">
                                        {{ $internalcode->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-code="{{$internalcode->internal_code}}" data-description="{{$internalcode->description}}" data-id="{{$internalcode->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.internalcode.destroy', [$internalcode->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
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
            <div id="update-div" class="box box-primary" hidden>
                <div class="box-header with-border">
                    <h3 class="box-title">Update Internal Code</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.internalcode.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('internal_code') ? ' has-error has-feedback' : '' }}">
                        <label for="internal-code">Internal Code</label>
                        <input type="text" class="form-control -flip-horizontal" id="internal-code"  name = "internal_code" autofocus placeholder="Enter Internal Code" value="{{ old('internal_code') }}">
                        {!! $errors->first('internal_code', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('description') ? ' has-error has-feedback' : '' }}">
                        <label for="description">Grades</label>
                        <input type="text" class="form-control -flip-horizontal" id="description"  name = "description" autofocus placeholder="Enter Description" value="{{ old('description') }}">
                        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="internalcode_id" id="internalcode-id">
                    <input type="hidden" name="old_internalcode" id="old-internalcode">
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary pull-left" id="btn-cancel-update">Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-xs-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Internal Code</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.internalcode.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('internal_code') ? ' has-error has-feedback' : '' }}">
                        <label for="internal-code">Internal Code</label>
                        <input type="text" class="form-control -flip-horizontal" id="internal-code"  name = "internal_code" autofocus placeholder="Enter Internal Code" value="{{ old('internal_code') }}">
                        {!! $errors->first('internal_code', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('description') ? ' has-error has-feedback' : '' }}">
                        <label for="description">Grades</label>
                        <input type="text" class="form-control -flip-horizontal" id="description"  name = "description" autofocus placeholder="Enter Description" value="{{ old('description') }}">
                        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
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
        <dd>{{ trans('admin::internalcodes.title.create internalcode') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.internalcode.create') ?>" }
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
                "sort": false,
                "info": true,
                "autoWidth": true,
                "order": false,
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
        $(".category-edit-button").click(function () {

            $("#internalcode-list").hide();

            $("#internalcode-id").val($(this).data("id"));
            $("#old-internalcode").val($(this).data("code"));
            $("#update-form").find('input[name="internal_code"]').val($(this).data("code"));
            $("#update-form").find('input[name="description"]').val($(this).data("description"));
            $("#update-div").show();
        });

        $("#btn-cancel-update").click(function(event){
            event.preventDefault();
            $("#internalcode-list").show();
            $("#update-div").hide();

        });
    </script>
@endpush

@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::checkmarks.title.checkmarks') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::checkmarks.title.checkmarks') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="checkmark-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>CM</th>
                                <th>Description</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($checkmarks)): ?>
                            <?php foreach ($checkmarks as $checkmark): ?>
                            <tr>
                                <td>{{$checkmark->cm}}</td>
                                <td>{{$checkmark->description}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.checkmark.edit', [$checkmark->id]) }}">
                                        {{ $checkmark->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-cm="{{$checkmark->cm}}" data-description="{{$checkmark->description}}" data-id="{{$checkmark->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.checkmark.destroy', [$checkmark->id]) }}"><i class="fa fa-trash"></i></button>
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
                    <h3 class="box-title">Update CM</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.checkmark.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('cm') ? ' has-error has-feedback' : '' }}">
                        <label for="cm">CM</label>
                        <input type="text" class="form-control -flip-horizontal" id="cm"  name = "cm" autofocus placeholder="Enter CM" value="{{ old('cm') }}">
                        {!! $errors->first('cm', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('description') ? ' has-error has-feedback' : '' }}">
                        <label for="description">Description</label>
                        <input type="text" class="form-control -flip-horizontal" id="description"  name = "description" autofocus placeholder="Enter Description" value="{{ old('description') }}">
                        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="checkmaster_id" id="checkmaster-id">
                    <input type="hidden" name="old_cm" id="old-cm">
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
                    <h3 class="box-title">CM</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.checkmark.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('cm') ? ' has-error has-feedback' : '' }}">
                        <label for="cm">CM</label>
                        <input type="text" class="form-control -flip-horizontal" id="cm"  name = "cm" autofocus placeholder="Enter CM" value="{{ old('cm') }}">
                        {!! $errors->first('cm', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('description') ? ' has-error has-feedback' : '' }}">
                        <label for="description">Description</label>
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
        <dd>{{ trans('admin::checkmarks.title.create checkmark') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.checkmark.create') ?>" }
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

            $("#checkmark-list").hide();

            $("#checkmaster-id").val($(this).data("id"));
            $("#old-cm").val($(this).data("cm"));
            $("#update-form").find('input[name="cm"]').val($(this).data("cm"));
            $("#update-form").find('input[name="description"]').val($(this).data("description"));
            $("#update-div").show();
        });

        $("#btn-cancel-update").click(function(event){
            event.preventDefault();
            $("#checkmark-list").show();
            $("#update-div").hide();

        });
    </script>
@endpush

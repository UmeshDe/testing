@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::employees.title.employees') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::employees.title.employees') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="supervisor-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($employees)): ?>
                            <?php foreach ($employees as $employee): ?>
                            <tr>
                                <td>{{$employee->first_name}}</td>
                                <td>{{$employee->last_name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.employee.edit', [$employee->id]) }}">
                                        {{ $employee->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-first_name="{{$employee->first_name}}" data-last_name="{{$employee->last_name}}" data-id="{{$employee->id}}" data-email="{{$employee->email}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.employee.destroy', [$employee->id]) }}"><i class="fa fa-trash"></i></button>
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
                    <h3 class="box-title">Update Supervisor</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.employee.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('first_name') ? ' has-error has-feedback' : '' }}">
                        <label for="first-name">First Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="first-name"  name = "first_name" autofocus placeholder="Enter First Name" value="{{ old('first_name') }}">
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('last_name') ? ' has-error has-feedback' : '' }}">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="last-name"  name = "last_name" autofocus placeholder="Enter First Name" value="{{ old('last_name') }}">
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                        <label for="email">Email</label>
                        <input type="text" class="form-control -flip-horizontal" id="email-id"  name = "email" autofocus placeholder="Enter Email" value="{{ old('email') }}">
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="supervisor_id" id="supervisor-id">
                    <input type="hidden" name="old_firstname" id="old-firstname">
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
                    <h3 class="box-title">New Supervisor</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.employee.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('first_name') ? ' has-error has-feedback' : '' }}">
                        <label for="first-name">First Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="first-name"  name = "first_name" autofocus placeholder="Enter First Name" value="{{ old('first_name') }}">
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('last_name') ? ' has-error has-feedback' : '' }}">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="last-name"  name = "last_name" autofocus placeholder="Enter First Name" value="{{ old('last_name') }}">
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                        <label for="email">Email</label>
                        <input type="text" class="form-control -flip-horizontal" id="email-id"  name = "email" autofocus placeholder="Enter Email" value="{{ old('email') }}">
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
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
        <dd>{{ trans('admin::employees.title.create employee') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.employee.create') ?>" }
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
        $(".category-edit-button").click(function () {

            $("#supervisor-list").hide();

            $("#supervisor-id").val($(this).data("id"));
            $("#old-firstname").val($(this).data("first_name"));
            $("#update-form").find('input[name="first_name"]').val($(this).data("first_name"));
            $("#update-form").find('input[name="last_name"]').val($(this).data("last_name"));
            $("#update-form").find('input[name="email"]').val($(this).data("email"));
            $("#update-div").show();
        });

        $("#btn-cancel-update").click(function(event){
            event.preventDefault();
            $("#supervisor-list").show();
            $("#update-div").hide();

        });
    </script>
@endpush

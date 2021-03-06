@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::grades.title.grades') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::grades.title.grades') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="grade-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Grade</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($grades))
                            @foreach ($grades as $grade)
                            <tr>
                                <td>{{$grade->grade}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.grade.edit', [$grade->id]) }}">
                                        {{ $grade->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-grade="{{$grade->grade}}" data-id="{{$grade->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.grade.destroy', [$grade->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                {{--<th>{{ trans('core::core.table.created at') }}</th>--}}
                                {{--<th>{{ trans('core::core.table.actions') }}</th>--}}
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
                    <h3 class="box-title">Grade</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.grade.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('grade') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Grade</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-grade"  name = "grade" autofocus placeholder="Enter Grade" value="{{ old('grade') }}">
                        {!! $errors->first('grade', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="grade_id" id="grade-id">
                    <input type="hidden" name="old_grade" id="old-grade">

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
                    <h3 class="box-title">Grade</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.grade.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('grade') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Grade</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-grade"  name = "grade" autofocus placeholder="Enter Grade" value="{{ old('grade') }}">
                        {!! $errors->first('grade', '<span class="help-block">:message</span>') !!}
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
        <dd>{{ trans('admin::grades.title.create grade') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.grade.create') ?>" }
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
            $('#select-all').on('click', function(){
                // Check/uncheck all checkboxes in the table
                var rows = categoryTable.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            $('#filetypedategory-table tbody').on('change', 'input[type="checkbox"]', function(){
                // If checkbox is not checked
                if(!this.checked){
                    var el = $('#select-all').get(0);
                    // If "Select all" control is checked and has 'indeterminate' property
                    if(el && el.checked && ('indeterminate' in el)){
                        // Set visual state of "Select all" control
                        // as 'indeterminate'
                        el.indeterminate = true;
                    }
                }
            });

            $(".category-edit-button").click(function () {

                $("#grade-list").hide();

                $("#grade-id").val($(this).data("id"));
                $("#old-grade").val($(this).data("grade"));

                $("#update-form").find('input[name="grade"]').val($(this).data("grade"));
                $("#update-div").show();
            });

            $("#btn-cancel-update").click(function(event){
                event.preventDefault();
                $("#grade-list").show();
                $("#update-div").hide();

            });


        });
    </script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\UpdateGradeRequest','#update-form')->render() !!}
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\CreateGradeRequest','#create-form')->render() !!}
@endpush


@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::cartontypes.title.cartontypes') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::cartontypes.title.cartontypes') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="cartontype-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($cartontypes))
                            @foreach($cartontypes as $cartontype)
                            <tr>
                                <td>{{$cartontype->type}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.cartontype.edit', [$cartontype->id]) }}">
                                        {{ $cartontype->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-type="{{$cartontype->type}}" data-id="{{$cartontype->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.cartontype.destroy', [$cartontype->id]) }}"><i class="fa fa-trash"></i></button>
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
                    <h3 class="box-title">Change Carton Type</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.cartontype.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('type') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Carton Type</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-type"  name = "type" autofocus placeholder="Enter Carton type" value="{{ old('type') }}">
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="type_id" id="type-id">
                    <input type="hidden" name="old_type" id="old-type">

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
                    <h3 class="box-title">Carton Type</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.cartontype.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('type') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Carton Type</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-type"  name = "type" autofocus placeholder="Enter Carton type" value="{{ old('type') }}">
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
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
        <dd>{{ trans('admin::cartontypes.title.create cartontype') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.cartontype.create') ?>" }
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

                $("#cartontype-list").hide();

                $("#type-id").val($(this).data("id"));
                $("#old-type").val($(this).data("type"));


                $("#update-form").find('input[name="type"]').val($(this).data("type"));
                $("#update-div").show();
            });

            $("#btn-cancel-update").click(function(event){
                event.preventDefault();
                $("#cartontype-list").show();
                $("#update-div").hide();

            });


        });
    </script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\UpdateCartonTypeRequest','#update-form')->render() !!}
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\CreateCartonTypeRequest','#create-form')->render() !!}
@endpush

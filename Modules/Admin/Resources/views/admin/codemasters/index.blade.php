@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::codemasters.title.codemasters') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::codemasters.title.codemasters') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div id="codemaster-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Is Parent</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($codemasters))
                            @foreach ($codemasters as $codemaster)
                            <tr>
                                <td>{{$codemaster->code}}</td>
                                <td>{{$codemaster->is_parent}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.codemaster.edit', [$codemaster->id]) }}">
                                        {{ $codemaster->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-name="{{$codemaster->name}}" data-id="{{$codemaster->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.codemaster.destroy', [$codemaster->id]) }}"><i class="fa fa-trash"></i></button>
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
                    <h3 class="box-title">Change Code Name</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.codemaster.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="codemaster_id" id="codemaster-id">
                    <input type="hidden" name="old_name" id="old-name">

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary pull-left" id="btn-cancel-update">Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-xs-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Code Name</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.codemaster.store'], 'method' => 'post','id'=>'create-form' , 'class' => 'form-horizontal' , 'align' => 'right']) !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('code') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="col-sm-2">Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control -flip-horizontal" id="type-code"  name = "code" autofocus placeholder="Enter Code" value="{{ old('code') }}">
                            {!! $errors->first('code', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('is_parent') ? ' has-error has-feedback' : '' }}">
                        <label for="name" class ="control-label col-sm-2">Is Parent:</label>
                        <div class="col-sm-8">
                            <select id="is-parent" name="is_parent" class="itemName dropdown">
                                @foreach($codemasters as $parentcode)
                                    <option></option>
                                    <option value="{{$parentcode->id}}">{{$parentcode->code}}</option>
                                @endforeach
                            </select>
                        </div>
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
        <dd>{{ trans('admin::codemasters.title.create codemaster') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.codemaster.create') ?>" }
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
            $('.itemName').select2({
                placeholder: 'Select an item',
                width: '100%',
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

                $("#codemaster-list").hide();

                $("#codemaster-id").val($(this).data("id"));
                $("#old-name").val($(this).data("name"));


                $("#update-form").find('input[name="name"]').val($(this).data("name"));
                $("#update-div").show();
            });

            $("#btn-cancel-update").click(function(event){
                event.preventDefault();
                $("#codemaster-list").show();
                $("#update-div").hide();

            });


        });
    </script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\UpdateCodeMasterRequest','#update-form')->render() !!}
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\CreateCodeMasterRequest','#create-form')->render() !!}
@endpush

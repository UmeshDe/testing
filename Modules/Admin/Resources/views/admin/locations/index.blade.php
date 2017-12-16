@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::locations.title.locations') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::locations.title.locations') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="location-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>City Name</th>
                                <th>Location</th>
                                <th>Sublocation</th>
                                <th>Landmark</th>
                                <th>Street</th>
                                <th>Details</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($locations))
                            @foreach ($locations as $location)
                            <tr>
                                <td>{{$location->name}}</td>
                                <td>{{$location->location}}</td>
                                <td>{{$location->sublocation}}</td>
                                <td>{{$location->landmark}}</td>
                                <td>{{$location->street}}</td>
                                <td>{{$location->details}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.location.edit', [$location->id]) }}">
                                        {{ $location->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-name="{{$location->name}}" data-location="{{$location->location}}" data-sublocation="{{$location->sublocation}}" data-landmark="{{$location->landmark}}" data-street="{{$location->street}}" data-details="{{$location->details}}" data-id="{{$location->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.location.destroy', [$location->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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
            <div id="update-div" class="box box-primary" hidden>
                <div class="box-header with-border">
                    <h3 class="box-title">Update Location</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.location.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">City Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Location</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-location"  name = "location" autofocus placeholder="Enter Location" value="{{ old('location') }}">
                        {!! $errors->first('location', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('sublocation') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Sublocation</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-sublocation"  name = "sublocation" autofocus placeholder="Enter Sublocation" value="{{ old('sublocation') }}">
                        {!! $errors->first('sublocation', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('landmark') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Landmark</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-landmark"  name = "landmark" autofocus placeholder="Enter Landmark" value="{{ old('landmark') }}">
                        {!! $errors->first('landmark', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('street') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Street</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-street"  name = "street" autofocus placeholder="Enter Street" value="{{ old('street') }}">
                        {!! $errors->first('street', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('details') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Details</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-details"  name = "details" autofocus placeholder="Enter Details" value="{{ old('details') }}">
                        {!! $errors->first('details', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="location_id" id="location-id">
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
        <div class="col-xs-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Location</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.location.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">City Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Location</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-location"  name = "location" autofocus placeholder="Enter Location" value="{{ old('location') }}">
                        {!! $errors->first('location', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('sublocation') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Sublocation</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-sublocation"  name = "sublocation" autofocus placeholder="Enter Sublocation" value="{{ old('sublocation') }}">
                        {!! $errors->first('sublocation', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('landmark') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Landmark</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-landmark"  name = "landmark" autofocus placeholder="Enter Landmark" value="{{ old('landmark') }}">
                        {!! $errors->first('landmark', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('street') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Street</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-street"  name = "street" autofocus placeholder="Enter Street" value="{{ old('street') }}">
                        {!! $errors->first('street', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('details') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name">Details</label>
                        <input type="text" class="form-control -flip-horizontal" id="type-details"  name = "details" autofocus placeholder="Enter Details" value="{{ old('details') }}">
                        {!! $errors->first('details', '<span class="help-block">:message</span>') !!}
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
        <dd>{{ trans('admin::locations.title.create location') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.location.create') ?>" }
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

                $("#location-list").hide();

                $("#location-id").val($(this).data("id"));
                $("#old-name").val($(this).data("name"));

                $("#update-form").find('input[name="name"]').val($(this).data("name"));
                $("#update-form").find('input[name="location"]').val($(this).data("location"));
                $("#update-form").find('input[name="sublocation"]').val($(this).data("sublocation"));
                $("#update-form").find('input[name="landmark"]').val($(this).data("landmark"));
                $("#update-form").find('input[name="street"]').val($(this).data("street"));
                $("#update-form").find('input[name="details"]').val($(this).data("details"));
                $("#update-div").show();
            });

            $("#btn-cancel-update").click(function(event){
                event.preventDefault();
                $("#location-list").show();
                $("#update-div").hide();

            });


        });
    </script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\UpdateLocationRequest','#update-form')->render() !!}
{!!  JsValidator::formRequest('Modules\Admin\Http\Requests\CreateLocationRequest','#create-form')->render() !!}
@endpush

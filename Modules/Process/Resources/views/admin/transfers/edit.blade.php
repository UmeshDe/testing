@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::transfers.title.edit transfer') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.process.transfer.index') }}">{{ trans('process::transfers.title.transfers') }}</a></li>
        <li class="active">{{ trans('process::transfers.title.edit transfer') }}</li>
    </ol>
@stop

@section('content')

    {{Former::populate($transfer)}}

    {!! Former::horizontal_open()
      ->route('admin.process.transfer.update',$transfer->id)
      ->method('put')
  !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                            @include('process::admin.transfers.partials.edit-fields')
                    <div class="box-footer">
                        {{--<button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>--}}
                        {{--<a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.process.transfer.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>--}}
                    </div>
            </div>
         </div> {{-- end nav-tabs-custom --}}
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.process.transfer.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
        $('#carton_date').datetimepicker({
            timepicker:false,
            format :'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });
        $('#product_date').datetimepicker({
            timepicker:false,
            format :'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });
        $('#loading_date').datetimepicker({
            format :'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });
        $('#loading_start_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });
        $('#loading_end_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });
        $('#unloading_date').datetimepicker({
            timepicker:false,
            format :'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });
        $('#unloading_start_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });
        $('#unloading_end_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });

        $('#transfer_lot').select2();
        $('#loading_location_id').select2();
        $('#unloading_location_id').select2();
        $('#status').select2();
        $('#loading_supervisor').select2();
        $('#unloading_supervisor').select2();

//        var ViewModel = function(model) {
//            var self = this;
//            this.carton[quantity] = ko.observableArray();
//            this.carton[recieved] = ko.observableArray(0);
//
//            this.carton[lost] = ko.computed(function () {
//                var value = self.carton[quantity]() - self.carton[recieved]();
//                return (value)?value:0;
//            });
//
////            this.gel_strength = ko.computed(function () {
////                var value = self.work_force() * self.length();
////                return (value)?value:0;
////            });
//        };
//        ko.applyBindings(new ViewModel());

    </script>
@endpush

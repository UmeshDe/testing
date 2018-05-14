@extends('layouts.master')

@section('content-header')

@stop

@section('content')

    {!! Former::populate($throwing) !!}


    {!! Former::horizontal_open()
       ->route('admin.process.throwing.update', $throwing->id)
       ->method('PUT')
   !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="box box-primary">
                    <div class="box box-primary">
                        <div class="box box-header">
                            @include('partials.form-tab-headers')
                                <h4>
                                    {{ trans('process::throwings.title.edit throwing') }}
                                </h4>
                        </div>
                    </div>
                    <div class="body">
                @include('process::admin.throwings.partials.edit-fields')
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-danger btn-flat" href="{{ route('admin.process.throwing.index')}}" style="margin-left: 35%"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%"><i class="fa fa-floppy-o" aria-hidden="true"></i>{{ trans('core::core.button.update') }}</button>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
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
                    { key: 'b', route: "<?= route('admin.process.throwing.index') ?>" }
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
    </script>

    <script>
        $('#product').select2();
        $('#location_id').select2();
        $('#thowing_supervisor,#available_quantity').select2();

        $('#carton_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($throwing->carton_date)->format(PHP_DATE_TIME_FORMAT)}}'
        });

        $('#thowing_start_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($throwing->thowing_start_time)->format(PHP_DATE_TIME_FORMAT)}}'
        });
        $('#thowing_end_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($throwing->thowing_end_time)->format(PHP_DATE_TIME_FORMAT)}}'
        });

    </script>
@endpush
{{--$('#location_id').select2().on('change' , function () {--}}
{{--var location = $(this).val();--}}
{{--$.ajax({--}}
{{--type: 'GET',--}}
{{--url: '{{URL::route('admin.process.carton.cartonLots')}}',--}}
{{--data: {--}}
{{--id : location,--}}
{{--_token: $('meta[name="token"]').attr('value'),--}}
{{--},--}}
{{--success : function (response) {--}}
{{--$('#product').html('');--}}
{{--$.each(response, function (i , item) {--}}
{{--var d =    item.carton_id;--}}
{{--$('#product').append('<option  value ='+item.id + ' >'+ 'Carton Date: '+ moment(item.carton.carton_date).format("DD-MMM-YY") + ' Lot: ' + item.carton.product.lot_no +' Qty: '+ item.available_quantity + '</option>');--}}
{{--});--}}

{{--},--}}
{{--error: function (xhr, ajaxOption, thrownError) {--}}
{{--}--}}

{{--});--}}
{{--});--}}

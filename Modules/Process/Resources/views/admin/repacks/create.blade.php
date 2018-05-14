@extends('layouts.master')

@section('content-header')
    {{--<ol class="breadcrumb">--}}
        {{--<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>--}}
        {{--<li><a href="{{ route('admin.process.repack.index') }}">{{ trans('process::repacks.title.repacks') }}</a></li>--}}
        {{--<li class="active">{{ trans('process::repacks.title.create repack') }}</li>--}}
    {{--</ol>--}}
@stop

@section('content')


    {!! Former::horizontal_open()
      ->route('admin.process.repack.store')
      ->method('POST')
  !!}

    {{ csrf_field() }}


    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="box box-primary">
                    <div class="box box-header">
                        @include('partials.form-tab-headers')
                        <h4>
                            {{ trans('process::repacks.title.create repack') }}
                        </h4>
                    </div>
                    <div class="box-body">
                        @include('process::admin.repacks.partials.create-fields')
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-danger btn-flat" href="{{ route('admin.process.repack.index')}}" style="margin-left: 30%"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%">{{ trans('core::core.button.create') }}</button>
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
                    { key: 'b', route: "<?= route('admin.process.repack.index') ?>" }
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
        $('#location_id').select2();
        $('#product').select2();
        $('#fishtype_id').select2();
        $('#bagcolor_id').select2();
        $('#cartontype_id').select2();
        $('#grade_id,#available_quantity').select2();

        // $('#product').select2().on('change', function () {
        //     var cartonId = $('#product').children('option:selected').data('cartonid');
        //     $('#ctId').val(cartonId);
        // });


        $('#repack_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });

        $('#location_id').select2().on('change' , function () {

            var loadingFrom = $(this).val();

            $.ajax({
                type: 'GET',
                url: '{{URL::route('admin.process.carton.cartonLots')}}',
                data: {
                    id : loadingFrom,
                    _token: $('meta[name="token"]').attr('value'),
                },
                success : function (response) {
                    $('#variety').html('<option/>');
                    $.each(response, function (i , item) {
                        $('#variety').append('<option  data-id ='+item.carton.product.fishtype.id+'  >'+ item.carton.product.fishtype.type + '</option>');
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

        $('#variety').select2().on('change' , function () {

            var type = $('#variety').children('option:selected').data('id');
            var loadingFrom = $('#location_id').val();

            $.ajax({
                type: 'GET',
                url: '{{URL::route('admin.process.carton.cartonDate')}}',
                data: {
                    type : type,
                    id : loadingFrom,
                    _token: $('meta[name="token"]').attr('value'),
                },
                success : function (response) {
                    $('#carton_date1').html('<option/>');
                    $.each(response, function (i , item) {
                        $('#carton_date1').append('<option data-date ='+item.carton_date+'>'+ moment(item.carton_date).format("DD-MMM-YY")  + '</option>');
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

        $('#carton_date1').select2().on('change' , function () {

            var cartonDate = $('#carton_date1').children('option:selected').data('date');
            var type = $('#variety').children('option:selected').data('id');
            var loadingFrom = $('#location_id').val();

            $.ajax({
                type: 'GET',
                url: '{{URL::route('admin.process.carton.lotNumber')}}',
                data: {
                    id : loadingFrom,
                    type : type,
                    cartonDate : cartonDate,
                    _token: $('meta[name="token"]').attr('value'),
                },
                success : function (response) {
                    $('#lot_no').html('<option/>');
                    $.each(response, function (i , item) {
                        $('#lot_no').append('<option data-lot_no ='+item.lot_no+' >'+ item.lot_no  + '</option>');
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

        $('#lot_no').select2().on('change' , function () {

            var lotNo = $('#lot_no').children('option:selected').data('lot_no');
            var cartonDate = $('#carton_date1').children('option:selected').data('date');
            var type = $('#variety').children('option:selected').data('id');
            var loadingFrom = $('#location_id').val();

            $.ajax({
                type: 'GET',
                url: '{{URL::route('admin.process.carton.availableQty')}}',
                data: {
                    id : loadingFrom,
                    type : type,
                    cartonDate : cartonDate,
                    lot : lotNo,
                    _token: $('meta[name="token"]').attr('value'),
                },
                success : function (response) {

                    $('#available_quantity').html('<option/>');
                    $.each(response, function (i , item) {
                        $('#available_quantity').append('<option data-cartonid ='+item.carton_id+' >'+ item.available_quantity  + '</option>');
                        $('#ctId').val(item.carton_id);
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

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
                        {{--$('#product').append($("<option></option>"));--}}
                        {{--$('#product').append('<option value = '+item.id +' data-quantity ='+item.available_quantity+' data-carton_date ='+item.carton.carton_date + ' data-cartonid =' + item.carton.id +' data-lot_no =' +item.carton.product.lot_no + ' data-location_id ='+ item.id+' >'+ 'Carton Date: '+ moment(item.carton.carton_date).format("DD-MMM-YY") + ' Lot: ' + item.carton.product.lot_no +' Qty: '+ item.available_quantity + '</option>');--}}
                    {{--});--}}

                {{--},--}}
                {{--error: function (xhr, ajaxOption, thrownError) {--}}
                {{--}--}}

            {{--});--}}
        {{--});--}}

        $('#repacked_cartons').focusout(function(){
            var number = parseInt($('#available_quantity').val());

            var repackedCartons = parseInt($(this).val());
            if (repackedCartons > number){
                alert("You cannot repack more than available quantity "+number);
                $(this).val(number);
            }
        });


    </script>
@endpush

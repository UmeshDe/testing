@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::transfers.title.create transfer') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.process.transfer.index') }}">{{ trans('process::transfers.title.transfers') }}</a></li>
        <li class="active">{{ trans('process::transfers.title.create transfer') }}</li>
    </ol>
@stop

@section('content')

    {{--@if($transfers->status ==  null)--}}
        {{Former::populate($transfers)}}
    {{--@else--}}


    {{--@endif--}}

    {!! Former::horizontal_open()
        ->route('admin.process.transfer.store')
        ->method('POST')
    !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
               @include('process::admin.transfers.partials.create-fields')


                    <div class="box-footer">
                        {{--<button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>--}}
                        {{--<a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.process.transfer.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>--}}
                    </div>
        </div>
    </div>
        </div>
    {!! Former::close() !!}
    @include('admin::modal.location-modal')
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

        {{--$('#carton_date').datetimepicker({--}}
            {{--timepicker:false,--}}
            {{--format :'{{PHP_DATE_FORMAT}}',--}}
            {{--value : new moment()--}}
        {{--});--}}
        $('#product_date').datetimepicker({
            timepicker:false,
            format :'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });
        $('#loading_date').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });
        $('#loading_start_time').datetimepicker({
            datepicker : false,
            format :'h:i:s a',
            value : new moment()
        });
        $('#loading_end_time').datetimepicker({
            datepicker : false,
            format :'h:i:s a',
            value : new moment()
        });
        $('#unloading_date').datetimepicker({
            timepicker:false,
            format :'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });
        $('#unloading_start_time').datetimepicker({
            datepicker : false,
            format :'h:i:s a',
            value : new moment()
        });
        $('#unloading_end_time').datetimepicker({
            datepicker : false,
            format :'h:i:s a',
            value : new moment()
        });


        $('#transfer_lot').select2({
            width: '100%'
        });
        $('#loading_location_id').select2();
        $('#unloading_location_id').select2();
        $('#variety,#carton_date,#lot_no,#available_quantity').select2();
        $('#status').select2({
            width: '100%'
        });
        $('#loading_supervisor').select2({
            width : '100%'
        });


        $('#loading_location_id').select2().on('change' , function () {

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
            var loadingFrom = $('#loading_location_id').val();

            $.ajax({
                type: 'GET',
                url: '{{URL::route('admin.process.carton.cartonDate')}}',
                data: {
                    type : type,
                    id : loadingFrom,
                    _token: $('meta[name="token"]').attr('value'),
                },
                success : function (response) {
                    $('#carton_date').html('<option/>');
                    $.each(response, function (i , item) {
                        $('#carton_date').append('<option data-date ='+item.carton_date+'>'+ moment(item.carton_date).format("DD-MMM-YY")  + '</option>');
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

        $('#carton_date').select2().on('change' , function () {

            var cartonDate = $('#carton_date').children('option:selected').data('date');
            var type = $('#variety').children('option:selected').data('id');
            var loadingFrom = $('#loading_location_id').val();

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
            var cartonDate = $('#carton_date').children('option:selected').data('date');
            var type = $('#variety').children('option:selected').data('id');
            var loadingFrom = $('#loading_location_id').val();

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
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

        function display() {
            var b = 0;

            var qty = parseInt($('#quantity').val());

            if(qty == "" || qty < 0 || qty != parseInt(qty, 10)) {
                alert("Please enter valid quantity");
                return false;
            }
            else if($('#variety').val() == ""){
                alert("Please select fish type");
                return false;
            }

            var quantity = parseInt($('#available_quantity').val());
            var lotno = $('#lot_no').val();
            var locationId = $('#transfer_lot').children('option:selected').data('location_id');

            if(qty > quantity){
                alert('Only ' + quantity+ " cartons are available in lot :" + lotno + " at selected location");
                return false;
            }


            $('#'+lotno).remove();


            var cartonId = $('#available_quantity').children('option:selected').data('cartonid');
            var toHTML = '';

            var cartondate="";

            if(moment($('#carton_date').val()).isValid())
            {
                cartondate = moment($('#carton_date').val()).format('{{MOMENT_DATE_FORMAT}}');
            }

            toHTML += '<tr  id =  ' +lotno+ '> <td style="text-align: center">' + cartondate  + '</td><td style="text-align: center">' + lotno + '</td><td style="text-align: center">'+ quantity + '</td><td style="text-align: center">'+ qty + '</td><td style="text-align: center">  <i  class ="fa fa-trash close" style="color:red; data-rowid = '+ lotno + '></i> </td><<input type="hidden" name="carton[cartonlocationId][]" value='+ locationId + '><input type="hidden" name="carton[quantity][]"  value =' + qty + '><input type="hidden" name="carton[cartonId][]"  value =' + cartonId + '></tr>';
            $('#records-table').append(toHTML);
            $('.close').click(function () {
                var id = $(this).data('rowid');
                $('#'+id).remove();
            });
        }

        $('#loading_location_id').change(function () {
           $('#loading').show();
        });
        $('#loading_location_id').select2({
            language: {
                noResults: function() {
                    return "<a data-toggle='modal' data-target='#location-modal''>Add</a>";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
        $('#unloading_location_id').select2({
            language: {
                noResults: function() {
                    return "<a data-toggle='modal' data-target='#location-modal''>Add</a>";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        $('#unloading_location_id').select2().on('change' , function () {
            var loadingFrom = $(this).val();
            var unloadingfrom = $('#loading_location_id').val();
            if(loadingFrom == unloadingfrom)
            {
                alert('Unloading Location Could Not Be Same As Loading Location');
                $('#unloading_location_id').val(null).trigger('change');
            }

        });
    </script>
@endpush

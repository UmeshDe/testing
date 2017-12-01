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
            format :'{{PHP_DATE_TIME_FORMAT}}',
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


        $('#transfer_lot').select2({
            width: '100%'
        });
        $('#loading_location_id').select2();
        $('#unloading_location_id').select2();
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

                    $('#transfer_lot').html('');
                    $.each(response, function (i , item) {
                        $('#transfer_lot').append('<option data-quantity ='+item.available_quantity+' data-carton_date ='+item.carton.carton_date + ' data-cartonid =' + item.carton.id +' data-lot_no =' +item.carton.product.lot_no + ' data-location_id ='+ item.id+' >'+ 'Carton Date: '+ moment(item.carton.carton_date).format("DD-MMM-YY") + ' Lot: ' + item.carton.product.lot_no +' Qty: '+ item.available_quantity + '</option>');
                    });

                },
                error: function (xhr, ajaxOption, thrownError) {
                }
            });
        });

        function display() {
            var b = 0;

            var qty = $('#quantity').val();

            if(qty == "" || qty < 0 || qty != parseInt(qty, 10)) {
                alert("Please enter valid quantity");
                return false;
            }
            else if($('#transfer_lot').val() == ""){
                alert("Please select product lot");
                return false;
            }

            var quantity = $('#transfer_lot').children('option:selected').data('quantity');
            var lotno = $('#transfer_lot').children('option:selected').data('lot_no');
            var locationId = $('#transfer_lot').children('option:selected').data('location_id');

            if(qty > quantity){
                alert('Only ' + quantity+ " cartons are available in lot :" + lotno + " at selected location");
                return false;
            }


            $('#'+lotno).remove();


            var cartonId = $('#transfer_lot').children('option:selected').data('cartonid');
            var toHTML = '';

            var cartondate="";

            if(moment($('#transfer_lot').children('option:selected').data('carton_date')).isValid())
            {
                cartondate = moment($('#transfer_lot').children('option:selected').data('carton_date')).format('{{MOMENT_DATE_FORMAT}}');
            }

            toHTML += '<tr  id =  ' +lotno+ '> <td>' + cartondate  + '</td><td >' + lotno + '</td><td >'+ quantity + '</td><td>'+ qty + '</td><td> <i  class ="fa fa-trash close" style="color:red" data-rowid = '+ lotno + '></i> </td><<input type="hidden" name="carton[cartonlocationId][]" value='+ locationId + '><input type="hidden" name="carton[quantity][]"  value =' + qty + '><input type="hidden" name="carton[cartonId][]"  value =' + cartonId + '></tr>';
            $('#records-table').append(toHTML);
            $('.close').click(function () {
                var id = $(this).data('rowid');
                $('#'+id).remove();
            });
        }

        $('#unloading_location_id').change(function () {
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
    </script>
@endpush

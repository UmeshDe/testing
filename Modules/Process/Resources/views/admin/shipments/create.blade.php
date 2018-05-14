@extends('layouts.master')

@section('content-header')
@stop

@section('content')

    {!! Former::horizontal_open_for_files()
       ->route('admin.process.shipment.store')
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
                        {{ trans('process::shipments.title.create shipment') }}
                    </h4>
                    </div>
                    <div class="body">
                @include('process::admin.shipments.partials.create-fields')
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-danger btn-flat" href="{{ route('admin.process.shipment.index')}}" style="margin-left: 35%"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%"><i class="fa fa-floppy-o" aria-hidden="true"></i>Prepare</button>
                        {{--{{ trans('core::core.button.create') }}--}}
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
                    { key: 'b', route: "<?= route('admin.process.shipment.index') ?>" }
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
        $('#transfer_lot').select2();
        $('#supervisor_id').select2();
        $('#varity,#available_quantity').select2();
        $('#start_time').datetimepicker({
            datepicker : false,
            format :'h:i:s a',
            value : new moment()
        });
        $('#end_time').datetimepicker({
            datepicker : false,
            format :'h:i:s a',
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
            var cartonDate = $('#carton_date').children('option:selected').data('date');
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

            toHTML += '<tr  id =  ' +lotno+ '> <td style="text-align: center">' + cartondate  + '</td><td style="text-align: center">' + lotno + '</td><td style="text-align: center">'+ quantity + '</td><td style="text-align: center">'+ qty + '</td><td style="text-align: center"> <i  class ="fa fa-trash close" style="color:red;float: center" data-rowid = '+ lotno + '></i> </td><<input type="hidden" name="carton[cartonlocationId][]" value='+ locationId + '><input type="hidden" name="carton[quantity][]"  value =' + qty + '><input type="hidden" name="carton[cartonId][]"  value =' + cartonId + '></tr>';
            $('#records-table').append(toHTML);
            $('.close').click(function () {
                var id = $(this).data('rowid');
                $('#'+id).remove();
            });
        }

    </script>
@endpush

@extends('layouts.master')

@section('content-header')
@stop

@section('content')

    {!! Former::horizontal_open()
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
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%"><i class="fa fa-floppy-o" aria-hidden="true"></i>{{ trans('core::core.button.create') }}</button>
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
        $('#varity').select2();
        $('#grade').select2();
        $('#start_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });
        $('#end_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });


        $("#location_id,#varity").select2().on('change' , function () {

            var location = $('#location_id').val();
            var fishtype = $('#varity').val();
            $.ajax({
                type: 'GET',
                url: '{{URL::route('admin.process.carton.getCartonsfromRelation')}}',
                data: {
                    id : location,
                    fishtype : JSON.stringify(fishtype),
                    _token: $('meta[name="token"]').attr('value'),
                },
                success : function (response) {

                    $('#transfer_lot').html('');
                    $.each(response, function (i , item) {
                        $('#transfer_lot').append('<option data-quantity ='+item.available_quantity + ' data-cartonid =' + item.carton.id +' data-lot_no =' +item.carton.product.lot_no + ' data-location_id ='+ item.id+' >'+ 'Carton Date: '+ moment(item.carton.carton_date).format("DD-MMM-YY") + ' Lot: ' + item.carton.product.lot_no +' Qty: '+ item.available_quantity + '</option>');
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

            toHTML += '<tr  id =  ' +lotno+ '> <td>' + cartondate  + '</td><td >' + lotno + '</td><td >'+ quantity + '</td><td>'+ qty + '</td><td> <button type="button" class ="glyphicon glyphicon-remove close" style="color:red" data-rowid = '+ lotno + '> </td><<input type="hidden" name="carton[cartonlocationId][]" value='+ locationId + '><input type="hidden" name="carton[quantity][]"  value =' + qty + '><input type="hidden" name="carton[cartonId][]"  value =' + cartonId + '></tr>';
            $('#records-table').append(toHTML);
            $('.close').click(function () {
                var id = $(this).data('rowid');
                $('#'+id).remove();
            });
        }

//        $('#unloading_location_id').change(function () {
//            $('#loading').show();
//        });

    </script>
@endpush

@extends('layouts.master')

@section('content-header')
@stop

@section('content')

    {!! Former::horizontal_open()
       ->route('admin.process.throwing.store')
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
                            {{ trans('process::throwings.title.create throwing') }}
                        </h4>
                    </div>
                    <div class="body">
                            @include('process::admin.throwings.partials.create-fields')
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-danger btn-flat" href="{{ route('admin.process.throwing.index')}}" style="margin-left: 35%"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%">{{ trans('core::core.button.create') }}</button>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Former::close() !!}
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
            value : new moment()
        });
        $('#thowing_start_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value : new moment()
        });
        $('#thowing_end_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
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

        {{--var cartonLocation = JSON.parse('@json($cartonlocation)');--}}

        {{--$('#available_loose_bages').val(cartonProducts);--}}

       {{--$('#product').select2({width:'100%'}).on('change', function () {--}}
            {{--var product = $(this).val();--}}
            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--url: '{{URL::route('admin.process.throwing.loose')}}',--}}
                {{--data: {--}}
                    {{--id : product,--}}
                    {{--_token: $('meta[name="token"]').attr('value'),--}}
                {{--},--}}
                {{--success : function (response) {--}}
                    {{--$('#available_loose_bags').html('');--}}
                    {{--$.each(response, function (i , item) {--}}
                        {{--$('#available_loose_bags').val(item.loose);--}}
                    {{--});--}}
                {{--},--}}
                {{--error: function (xhr, ajaxOption, thrownError) {--}}
                {{--}--}}

            {{--});--}}
        {{--});--}}
    </script>
    <script>

        // $('#lot_no').select2().on('change', function () {
        //     var cartonId = $('#available_quantity').children('option:selected').data('cartonid');
        //     $('#ctId').val(cartonId);
        // });

        var ViewModel = function(model) {

            var self = this;
            this.throwing_input = ko.observable(0);
            this.throwing_output_bags = ko.observable(0);
            this.loose_bags = ko.observable();

            this.throwing_input_bags = ko.computed(function () {
                var value = self.throwing_input() * 2;
                return (value)?value:0;
            });

            this.throwing_output = ko.computed(function(){
                if(self.throwing_output_bags() % 2 == 0 )
                {
                    var value = Math.ceil(self.throwing_output_bags()/2);
                    return (value)?value:0;
                }else {
                    var value = Math.ceil(self.throwing_output_bags()/parseFloat(2)) - self.loose_bags();
                    return (value)?value:0;
                }
            });

            this.loose_bags = ko.computed(function () {
               if(self.throwing_output_bags() % 2 == 0 )
               {
                   return 0;
               }else {
                   return 1;
               }
            });
        };

        ko.applyBindings(new ViewModel({{$throwing}}));

        $('#throwing_input').keyup(function(){
            var number = $('#available_quantity').val();
            if ($(this).val() > number){
                alert("You cannot thow more than available quantity "+number);
                $(this).val(number);
            }
        });


    </script>
@endpush

@extends('layouts.master')

@section('content-header')
    {{--<h1>--}}
        {{--{{ trans('process::products.packing.create packing') }}--}}
    {{--</h1>--}}
@stop

@section('content')

    {{Former::populate($product)}}


    {!! Former::horizontal_open()
       ->route('admin.process.product.update', $product->id)
       ->method('PUT')
   !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            @include('partials.form-tab-headers')
            @include('process::admin.products.partials.edit-fields')

            <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-save"></i>{{ trans('core::core.button.create') }}</button>
            <a class="btn btn-danger pull-left btn-flat" href="{{ route('admin.process.product.index')}}"><i
                        class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
        </div> {{-- end nav-tabs-custom --}}
    </div>

    {!! Form::close() !!}

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
    $(document).ready(function () {
        $(document).keypressAction({
            actions: [
                {key: 'b', route: "<?= route('admin.process.product.index') ?>"}
            ]
        });
    });
</script>
<script>

    var selectcodes;

    $(document).ready(function () {
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });


        $('#product_date').datetimepicker({
            timepicker: false,
            format: '{{PHP_DATE_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($product->product_date)->format(PHP_DATE_FORMAT)}}'
        });

        $('#carton_date').datetimepicker({
            timepicker: false,
            format: '{{PHP_DATE_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($product->carton_date)->format(PHP_DATE_FORMAT)}}'
        });

        $('.select').select2();


        // var slab = $('#product_slab').val();
        //
        // outputCMVal = Math.round(slab)/20;
        //
        // var arrDecimal = outputCMVal.toString().split('.');
        //
        // $('#no_of_cartons').val(arrDecimal[0]);
        // if(arrDecimal[1] == 5)
        // {
        //     var loose = 1;
        // }
        // $('#loose').text(loose);
        // $('#loose').val(loose);


        {{--selectcodes = $("#code").selectize({--}}
            {{--options: [--}}
                    {{--@foreach($codemasters as $codemaster)--}}
                        {{--@foreach($codemaster->childCodes as $childCode)--}}
                        {{--{--}}
                            {{--id: '{{$childCode->id}}', make: '{{$codemaster->id}}', model: '{{$childCode->code}}'--}}
                        {{--},--}}
                        {{--@endforeach--}}
                    {{--@endforeach--}}
            {{--],--}}
            {{--optgroups: [--}}
                    {{--@foreach($codemasters as $codemaster)--}}
                    {{--{--}}
                        {{--id: '{{$codemaster->id}}', name: '{{$codemaster->code}}'--}}
                    {{--},--}}
                    {{--@endforeach--}}
            {{--],--}}
            {{--labelField: 'model',--}}
            {{--valueField: 'id',--}}
            {{--optgroupField: 'make',--}}
            {{--optgroupLabelField: 'name',--}}
            {{--optgroupValueField: 'id',--}}
            {{--searchField: ['model'],--}}
            {{--plugins: ['optgroup_columns']--}}
        {{--});--}}


        {{--selectcodes[0].selectize.addItems(@json(collect($product->codes->toArray())->pluck('id')->all()));--}}
    });


    var ViewModel = function (model) {

        var self = this;
        this.product_slab = ko.observable(model.product_slab);
        this.rejected = ko.observable(model.rejected);
        this.human_error_slab = ko.observable(model.human_error_slab);
        this.human_error_plus = ko.observable(model.human_error_plus);
        this.loose = ko.observable(model.loose);
        this.no_of_cartons = ko.observable(model.no_of_cartons);

        this.no_of_cartons = ko.computed(function () {
            var value = self.product_slab() / 20 - (Math.ceil((self.rejected())) / 2) - (Math.ceil((self.loose())) / 2) - (Math.ceil((self.human_error_slab())) / 2) + (Math.ceil((self.human_error_plus())) / 2) ;

            if(self.rejected() * 10 > self.product_slab() || self.loose() * 10 > self.product_slab() || self.human_error_slab() * 10 > self.product_slab())
            {
               alert('Enter bag is more than production bag');
            }

            return (value) ? value : 0;
        });

        // this.loose = ko.computed(function () {

            // var value = (self.rejected() % 2);
            //
            // return (value) ? value : 0;
            // var value = self.product_slab() / 20 ;
            // return (value) ? value : 0;
            // if(value % 2 !== 0)
            // {
            //     var arrDecimal = value.toString().split('.');
            //     var loose = 1;
            //     var rejected = self.rejected() % 2;
            //     var total = parseInt(loose) + parseInt(rejected);
            // }
            // else {
            //     var total = 0;
            // }

        // });

        this.diff_in_kg = ko.computed(function () {
           var value = self.product_slab() - (self.no_of_cartons() * 20);
           return (value) ? value : 0;
        });
    };

    ko.applyBindings(new ViewModel(@json($product)));


    // $('#rejected').keyup(function () {
    //
    //     var rejected = $(this).val();
    //
    //     outputCMVal = Math.round(rejected)/2;
    //
    //     var arrDecimal = outputCMVal.toString().split('.');
    //
    //     // alert(arrDecimal[0]);
    //     // alert(arrDecimal[1]);
    //     var cartons = $('#no_of_cartons').val();
    //     var loosebags = $('#loose').val();
    //
    //     $('#no_of_cartons').val(cartons - arrDecimal[0]);
    //     if(arrDecimal[1] == 5)
    //     {
    //         var totalbags = parseInt(loosebags) + 1;
    //         $('#loose').text(totalbags);
    //         $('#loose').val(totalbags);
    //     }
    //
    //     if($('#loose').val() == 2)
    //     {
    //         var cartons = $('#no_of_cartons').val();
    //         $('#no_of_cartons').val(parseInt(cartons) + 1);
    //         $('#loose').val(0);
    //         $('#loose').text(0);
    //     }
    //
    // })

</script>

@endpush

@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::products.title.edit product') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.process.product.index') }}">{{ trans('process::products.title.products') }}</a>
        </li>
        <li class="active">{{ trans('process::products.title.edit product') }}</li>
    </ol>
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
            @include('process::admin.products.partials.create-fields')

            <button type="submit" class="btn btn-primary pull-right btn-flat">{{ trans('core::core.button.update') }}</button>
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


        selectcodes = $("#code").selectize({
            options: [
                    @foreach($codemasters as $codemaster)
                        @foreach($codemaster->childCodes as $childCode)
                        {
                            id: '{{$childCode->id}}', make: '{{$codemaster->id}}', model: '{{$childCode->code}}'
                        },
                        @endforeach
                    @endforeach
            ],
            optgroups: [
                    @foreach($codemasters as $codemaster)
                    {
                        id: '{{$codemaster->id}}', name: '{{$codemaster->code}}'
                    },
                    @endforeach
            ],
            labelField: 'model',
            valueField: 'id',
            optgroupField: 'make',
            optgroupLabelField: 'name',
            optgroupValueField: 'id',
            searchField: ['model'],
            plugins: ['optgroup_columns']
        });


        selectcodes[0].selectize.addItems(@json(collect($product->codes->toArray())->pluck('id')->all()));
    });


    var ViewModel = function (model) {

        var self = this;
        this.product_slab = ko.observable(model.product_slab);
        this.rejected = ko.observable(model.rejected);

        this.no_of_cartons = ko.computed(function () {
            var value = self.product_slab() / 20 - Math.ceil((self.rejected() / parseFloat(2)));
            return (value) ? value : 0;
        });

        this.loose = ko.computed(function () {
            var value = (self.rejected() % 2);
            return (value) ? value : 0;
        });
    };

    ko.applyBindings(new ViewModel(@json($product)));
</script>

{{--<style>--}}
{{--.address{--}}
{{--width: 100% !important;--}}
{{--}--}}
{{--</style>--}}
@endpush

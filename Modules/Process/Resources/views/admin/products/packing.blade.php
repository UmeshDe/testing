@extends('layouts.master')

@section('content-header')

@stop


@section('content')

    {{Former::populate($product)}}


    {!! Former::horizontal_open()
        ->route('admin.process.product.store')
        ->method('POST')
    !!}

    {{ csrf_field() }}

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">New Production</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="control-label col-sm-5">ApprovalNo:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::select('approval_no')
                                ->addOption(null)
                                ->fromQuery($approvalnumbers,'name','id')
                                ->addClass('select')
                                ->raw()
                             !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('po_no') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="control-label col-sm-5">PO No:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::text('po_no')->raw()
                                ->readonly()
                             !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>

            <div class="row">
                {{--<div class="col-md-4">--}}
                {{--<label class="control-label col-sm-5">{{trans('process::products.productdate')}}:</label>--}}
                {{--<div class="input-group">--}}
                {{--{!! Former::text('product_date')->raw() !!}--}}
                {{--<div class="input-group-addon">--}}
                {{--<i class="fa fa-clock-o"></i>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                {{--<label class="control-label col-sm-5">CartonDate:</label>--}}
                {{--<div class="input-group">--}}
                {{--{!! Former::text('carton_date')->raw() !!}--}}
                {{--<div class="input-group-addon">--}}
                {{--<i class="fa fa-clock-o"></i>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-md-4">
                    <div class="bootstrap-timepicker">
                        <div class="form-group has-feedback">
                            <label class="control-label col-sm-5">{{trans('process::products.productdate')}}:</label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    {!! Former::text('product_date')->raw() !!}
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bootstrap-timepicker">
                        <div class="form-group has-feedback">
                            <label class="control-label col-sm-5">CartonDate:</label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    {!! Former::text('carton_date')->raw() !!}
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    {!!  Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 5, 'small' => 3]) !!}
                    {!! Former::text('lot_no')
                              !!}
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                        <label for="product_slab" class="control-label col-sm-5">Slab:</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('product_slab')->data_bind("value: product_slab,valueUpdate: 'afterkeydown'")->raw()!!}
                                <div class="input-group-addon">
                                    <b class="">Kg</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('lot_no') ? ' has-error has-feedback' : '' }}">--}}
                {{--<label for="type-name" class="control-label col-sm-5">Lot No:</label>--}}
                {{--<div class="col-sm-7">--}}
                {{--{!! Former::text('lot_no')->raw()--}}
                {{--!!}--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('product_slab') ? ' has-error has-feedback' : '' }}">--}}
                {{--<label for="product_slab" class="control-label col-sm-5">Slab:</label>--}}
                {{--<div class="col-sm-7">--}}

                {{--<div class="input-group">--}}
                {{--{!! Former::text('product_slab')->data_bind("value: product_slab,valueUpdate: 'afterkeydown'")->raw()!!}--}}
                {{--<div class="input-group-addon">--}}
                {{--<b class="">Kg</b>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="control-label col-sm-5">CartonNo:</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('no_of_cartons')->data_bind('value: no_of_cartons')->raw() !!}
                                <div class="input-group-addon">
                                    <b class="">Cartons</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('rejected') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="control-label col-sm-5">Rejected:</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('rejected')->data_bind("value: rejected,valueUpdate: 'afterkeydown'")->raw() !!}
                                <div class="input-group-addon">
                                    <b class="">Bags</b>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('loose') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="control-label col-sm-5">Loose:</label>
                        <div class="col-sm-7">
                            {!! Former::hidden('loose')->data_bind('value: loose')->raw() !!}
                            <span class="form-control"  style="width:100%" data-bind ='text: loose' />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">
                        <label for="fish_type" class="control-label col-sm-5">{{trans('process::products.fishtype')}}:</label>
                        <div class="col-sm-7">
                            {!!
                                 Former::select('fish_type')
                                 ->addOption(null)
                                ->fromQuery($fishtypes,'type','id')
                                ->addClass('select')
                                ->raw()

                             !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('bag_color') ? ' has-error has-feedback' : '' }}">
                        <label for="type-name" class="control-label col-sm-5">Bag Color:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::select('bag_color')
                                ->addOption(null)
                               ->fromQuery($bagcolors,'color','id')
                               ->addClass('select')
                               ->raw()

                            !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('carton_type') ? 'has-erro has-feedback' : '' }}">
                        <label for="carton_type" class="control-label col-sm-5">{{ trans('process::products.cartontype') }}:</label>
                        <div class="col-sm-7">
                            {!!
                               Former::select('carton_type')
                               ->addOption(null)
                              ->fromQuery($cartontypes,'type','id')
                              ->addClass('select')
                              ->raw()
                           !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('remark') ? 'has-erro has-feedback' : '' }}">
                        <label for="remark" class="control-label col-sm-5">{{ trans('process::products.remark') }}:</label>
                        <div class="col-sm-7">
                            {!! Former::text('remark')->raw() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">
                        <label class="control-label col-sm-3">Location:</label>
                        <div class="col-sm-8">
                            {!!
                                 Former::select('location_id')
                                 ->addOption(null)
                                ->fromQuery($locations,'name','id')
                                ->addClass('select')
                                ->raw()
                             !!}
                            <a href="#" data-toggle="modal" data-target="#location-modal"  >Add New Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="form-group has-feedback {{ $errors->has('codes') ? ' has-error has-feedback' : '' }}">
                        <label for="code" class="control-label col-sm-1">Codes:</label>
                        <div class="col-sm-11">
                            <select multiple id = 'code' name = code[]></select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'b', route: "<?= route('admin.process.product.index') ?>" }
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


        $('#product_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
            {{--value: '{{isset($product)?$product->product_date:\Carbon\Carbon::now()}}'--}}
            value : new moment()
        });

        $('#carton_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
            value : new moment()
        });

        $('.select').select2();

        $("#code").selectize({
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
    });


    var ViewModel = function(model) {

        var self = this;
        this.product_slab = ko.observable();
        this.rejected = ko.observable(0);

        this.no_of_cartons = ko.computed(function () {
            var value = self.product_slab()/20 - Math.ceil((self.rejected()/parseFloat(2)));
            return (value)?value:0;
        });

        this.loose = ko.computed(function(){
            var value = (self.rejected()%2);
            return (value)?value:0;
        });
    };

    ko.applyBindings(new ViewModel({{$product}}));

</script>


@endpush

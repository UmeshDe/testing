<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">New Packing</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">EIA No</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('approval_no')
                            ->disabled()
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
                    <label for="type-name" class="control-label col-sm-5">PO No</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('po_no')->raw()
                            ->readonly()
                         !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('bc') ? ' has-error has-feedback' : '' }}">
                    <label for="type-bc" class="control-label col-sm-5">Buyer Code</label>
                    <div class="col-sm-7">
                        {!!
                           Former::select('buyercode_id')
                           ->disabled()
                           ->addOption(null)
                           ->fromQuery($buyercode,'buyer_code','id')
                           ->addClass('select')
                           ->raw()
                        !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="bootstrap-timepicker">
                    <div class="form-group has-feedback">
                        <label class="control-label col-sm-5">{{trans('process::products.productdate')}}</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('product_date')->raw()
                                 ->readonly()
                                 !!}
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">
                    <label for="fish_type" class="control-label col-sm-5">{{trans('process::products.fishtype')}}</label>
                    <div class="col-sm-7">
                        {!!
                             Former::select('fish_type')
                             ->disabled()
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
                    <label for="type-name" class="control-label col-sm-5">Bag Color</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('bag_color')
                           ->disabled()
                           ->addOption(null)
                           ->fromQuery($bagcolors,'color','id')
                           ->addClass('select')
                           ->raw()
                        !!}

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                {!!  Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 5, 'small' => 3]) !!}
                {!! Former::text('lot_no')
                ->readonly()
                          !!}
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                    <label for="product_slab" class="control-label col-sm-5">Slab</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('product_slab')->data_bind("value: product_slab,valueUpdate: 'afterkeydown'")->raw()
                            ->readonly()
                            !!}

                            <div class="input-group-addon">
                                <b class="">Kg</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">CartonNo</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('no_of_cartons')->data_bind('value: no_of_cartons')->raw()
                             ->readonly()
                             !!}
                            <div class="input-group-addon">
                                <b class="">Cartons</b>
                            </div>
                        </div>
                        {{$errors->first('no_of_cartons')}}
                    </div>
                </div>
            </div>
        </div>
        {{--@if($product->human_error_slab == null && $product->rejected == null && $product)--}}
        {{--@endif--}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('diff_in_kg') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Diff In Kg</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('diff_in_kg')->data_bind('value: diff_in_kg')->raw()
                            ->readonly()
                            !!}
                            <div class="input-group-addon">
                                <b class="">Kg</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bootstrap-timepicker">
                    <div class="form-group has-feedback">
                        <label class="control-label col-sm-5">CartonDate</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('carton_date')->raw()
                                ->readonly()
                                 !!}
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

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('packing_remark') ? 'has-erro has-feedback' : '' }}">
                    <label for="packing_remark" class="control-label col-sm-5">Packing Remark</label>
                    <div class="col-sm-7">
                        {!! Former::text('packing_remark')->raw()
                         !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback {{ $errors->has('location_id') ? ' has-error has-feedback' : '' }}">
                    <label class="control-label col-sm-3">Location</label>
                    <div class="col-sm-8">
                        {!!
                             Former::select('location_id')
                             ->addOption(null)
                            ->fromQuery($locations,'name','id')
                            ->addClass('select')
                            ->raw()
                         !!}
                        {{$errors->first('location_id')}}
                        <a href="#" data-toggle="modal" data-target="#location-modal"  >Add New Location</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('carton_type') ? 'has-erro has-feedback' : '' }}">
                    <label for="carton_type" class="control-label col-sm-5">{{ trans('process::products.cartontype') }}</label>
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
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('cm_id') ? ' has-error has-feedback' : '' }}">
                    <label for="cm" class="control-label col-sm-5">CM</label>
                    <div class="col-sm-7">
                        {!!
                             Former::select('cm_id')
                             ->addOption(null)
                            ->fromQuery($cm,'cm','id')
                            ->addClass('select')
                            ->raw()
                         !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('rejected') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Rejected</label>
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
                    <label for="type-name" class="control-label col-sm-5">Loose</label>
                    <div class="col-sm-7">
                        {!! Former::text('loose')->data_bind("value: loose,valueUpdate: 'afterkeydown'")->raw() !!}
                        {{--<span class="form-control" name="loose" id="loose" style="width:100%" data-bind ='text: loose' />--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('human_error_slab') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">HumanError Minus</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('human_error_slab')->data_bind("value: human_error_slab,valueUpdate: 'afterkeydown'")->raw() !!}
                            <div class="input-group-addon">
                                <b class="">Bags</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('human_error_plus') ? ' has-error has-feedback' : '' }}">
                    <label for="type-human_error_plus" class="control-label col-sm-5">HumanError Plus</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('human_error_plus')->data_bind("value: human_error_plus,valueUpdate: 'afterkeydown'")->raw() !!}
                            <div class="input-group-addon">
                                <b class="">Bags</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>













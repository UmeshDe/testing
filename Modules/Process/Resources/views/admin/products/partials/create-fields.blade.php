<div class="box box-primary">
    <div class="box-header with-border">
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
                         !!}

                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>

        <div class="row">
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
                <div class="form-group has-feedback {{ $errors->has('lot_no') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Lot No:</label>
                    <div class="col-sm-7">
                        {!! Former::text('lot_no')->raw() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('product_slab') ? ' has-error has-feedback' : '' }}">
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
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">CartonNo:</label>
                    <div class="col-sm-7">
                        {!! Former::text('no_of_cartons')->data_bind('value: no_of_cartons')->raw() !!}
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
                        <span data-bind ='text: loose' />

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
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">
                    <label class="control-label col-sm-5">Location:</label>
                    <div class="col-sm-7">
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










<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">ApprovalNo:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('approval_no')
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
                        <label class="control-label col-sm-5">{{trans('production::products.productdate')}}:</label>
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
                <div class="form-group has-feedback {{ $errors->has('production_slab') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Slab:</label>
                    <div class="col-sm-7">
                        {!! Former::text('production_slab')->raw() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">CartonNo:</label>
                    <div class="col-sm-7">
                        {!! Former::text('no_of_cartons')->raw() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('rejected') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Rejected:</label>
                    <div class="col-sm-7">
                        {!! Former::text('rejected')->raw() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('loose') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Loose:</label>
                    <div class="col-sm-7">
                        {!! Former::text('loose')->raw() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">
                    <label for="fish_type" class="control-label col-sm-5">{{trans('production::products.fishtype')}}:</label>
                    <div class="col-sm-7">
                        {!!
                             Former::select('fish_type')
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
                           ->fromQuery($bagcolors,'color','id')
                           ->addClass('select')
                           ->raw()

                        !!}

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('carton_type') ? 'has-erro has-feedback' : '' }}">
                    <label for="type-remark" class="control-label col-sm-5">{{ trans('production::products.cartontype') }}:</label>
                    <div class="col-sm-7">
                        {!!
                           Former::select('carton_type')
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
                    <label for="remark" class="control-label col-sm-5">{{ trans('production::products.remark') }}:</label>
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
                            ->fromQuery($locations,'name','id')
                            ->addClass('select')
                            ->raw()

                         !!}
                        <a href="#" data-toggle="modal" data-target="#modalForm" onclick="createLocation()" >Add New Location</a>
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










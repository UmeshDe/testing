<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('repack_date') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Repacking Date:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('repack_date')->raw() !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('location_id') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Location:</label>
                <div class="col-sm-7">
                    {!!
                     Former::select('location_id')->raw()
                      ->addOption(null)
                     ->fromQuery($locations,'name','id')
                     ->addClass('select')
                     !!}
                </div>
                <input type="hidden" name="cartId" id="ctId">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('product') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Carton:</label>
                <div class="col-sm-7">
                    {!!
                        Former::select('product')->raw()

                        ->addOption(null)
                        ->addClass('select')
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('lot_no') ? ' has-error has-feedback' : '' }}">
                <label for="lot_no" class="control-label col-sm-4">Lot No:</label>
                <div class="col-sm-7">
                    {!!
                         Former::text('lot_no')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('bagcolor_id') ? ' has-error has-feedback' : '' }}">
                <label for="type-nbag-color" class="control-label col-sm-4">Bag Color:</label>
                <div class="col-sm-7">
                    {!!
                        Former::select('bagcolor_id')
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
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('cartontype_id') ? 'has-erro has-feedback' : '' }}">
                <label for="carton_type" class="control-label col-sm-4">{{ trans('process::products.cartontype') }}:</label>
                <div class="col-sm-7">
                    {!!
                       Former::select('cartontype_id')
                       ->addOption(null)
                      ->fromQuery($cartontypes,'type','id')
                      ->addClass('select')
                      ->raw()
                   !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('fishtype_id') ? ' has-error has-feedback' : '' }}">
                <label for="fish_type" class="control-label col-sm-4">{{trans('process::products.fishtype')}}:</label>
                <div class="col-sm-7">
                    {!!
                         Former::select('fishtype_id')
                         ->addOption(null)
                        ->fromQuery($fishtypes,'type','id')
                        ->addClass('select')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('repacked_cartons') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">No Of Cartonss:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('repacked_cartons')->raw()
                         !!}
                        <div class="input-group-addon">
                            <b class="">Cartons</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('grade_id') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Grade:</label>
                <div class="col-sm-7">
                    {!!
                         Former::select('grade_id')
                         ->addOption(null)
                        ->fromQuery($grade,'type','id')
                        ->addClass('select')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('remark') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Repacking Remark:</label>
                <div class="col-sm-7">
                    {!!
                        Former::textarea('remark')->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
</div>

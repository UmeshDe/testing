<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group has-feedback {{ $errors->has('carton_date') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">New CartonDate:</label>
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
    <div class="row">
        <div class="col-md-4">
            <div class="form-group has-feedback {{ $errors->has('location_id') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Location:</label>
                <div class="col-sm-7">
                    {!!
                     Former::select('location_id')->raw()
                     ->fromQuery($locations,'name','id')
                     ->addOption(null)
                     ->addClass('select')
                     !!}
                </div>
                <input type="hidden" name="cartId" id="ctId">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback {{ $errors->has('product_date') ? ' has-error has-feedback' : '' }}">
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
        <div class="col-md-4">
            <div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">
                <label for="fish_type" class="control-label col-sm-4">{{trans('process::products.fishtype')}}:</label>
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
                <label for="type-name" class="control-label col-sm-4">Bag Color:</label>
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
                <label for="carton_type" class="control-label col-sm-4">{{ trans('process::products.cartontype') }}:</label>
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
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('damaged_cartons') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Damaged Cartons:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('damaged_cartons')->raw()
                         !!}
                        <div class="input-group-addon">
                            <b class="">Cartons</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('repacked_cartons') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Repacked Cartons:</label>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Comment:</label>
                <div class="col-sm-7">
                    {!!
                        Former::textarea('comment')->raw()

                     !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('carton_date') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-3">CartonDate:</label>
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
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('location_id') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-3">Location:</label>
                <div class="col-sm-7">
                    {!!
                     Former::select('location_id')->raw()
                     ->addOption(null)
                     ->fromQuery($locations,'product','id')
                     ->addClass('select')
                     !!}
                </div>
                <input type="hidden" name="cartId" id="ctId">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('product_date') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-3">Carton:</label>
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
            <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-3">Throwing Input:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('throwing_input')->raw() !!}
                        <div class="input-group-addon">
                            <b class="">Cartons</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-3">Throwing Output:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('throwing_output')->raw() !!}
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
                <label class="control-label col-sm-3">Comment:</label>
                <div class="col-sm-7">
                    {!!
                        Former::textarea('comment')->raw()

                     !!}
                </div>
            </div>
        </div>
    </div>
</div>
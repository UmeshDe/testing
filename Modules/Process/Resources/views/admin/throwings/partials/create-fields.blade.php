<div class="box-body">
    <div class="row">
        <div class="col-md-6">
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
    </div>
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('throwing_input') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Throwing Input:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('throwing_input')->raw()
                         ->data_bind("value: throwing_input,valueUpdate: 'afterkeydown'")
                         !!}
                        <div class="input-group-addon">
                            <b class="">Cartons</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('throwing_input_bags')->raw()
                          ->data_bind("value: throwing_input_bags,valueUpdate: 'afterkeydown'")
                          !!}
                        <div class="input-group-addon">
                            <b class="">Bags</b>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('throwing_output_bags') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Throwing Output:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('throwing_output_bags')->raw()
                            ->data_bind("value: throwing_output_bags,valueUpdate: 'afterkeydown'")
                         !!}
                        <div class="input-group-addon">
                            <b class="">Bags</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-sm-7">
                <div class="input-group">
                    {!! Former::text('throwing_output')->raw()
                         ->data_bind("value: throwing_output,valueUpdate: 'afterkeydown'")
                     !!}
                    <div class="input-group-addon">
                        <b class="">Cartons</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('loose_bags') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Loose Bags:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('loose_bags')->raw()
                            ->data_bind("value: loose_bags,valueUpdate: 'afterkeydown'")
                         !!}
                        <div class="input-group-addon">
                            <b class="">Bags</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('available_loose_bags') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-3">Available Bags:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('available_loose_bags')->raw()
                         !!}
                        {{--->data_bind("value: available_loose_bags,valueUpdate: 'afterkeydown'")--}}
                        <div class="input-group-addon">
                            <b class="">Bags</b>
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
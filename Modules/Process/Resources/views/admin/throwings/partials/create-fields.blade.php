<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('carton_date') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Thowing Date:</label>
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
            <div class="bootstrap-timepicker">
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-4">Start Time:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('thowing_start_time')->raw() !!}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bootstrap-timepicker">
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-4">End Time:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('thowing_end_time')->raw() !!}
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
            <div class="form-group has-feedback {{ $errors->has('thowing_supervisor') ? ' has-error has-feedback' : '' }}">
                <label for="thowing_supervisor" class="control-label col-sm-4">Supervisor:</label>
                <div class="col-sm-7">
                    {!!
                         Former::select('thowing_supervisor')
                         ->addOption(null)
                        ->fromQuery($users,'first_name','id')
                        ->addClass('select')
                        ->raw()
                     !!}
                </div>
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
        {{--<div class="col-md-6">--}}
                {{--<div class="col-sm-7">--}}
                    {{--<div class="input-group">--}}
                        {{--{!! Former::text('throwing_input_bags')->raw()--}}
                          {{--->data_bind("value: throwing_input_bags,valueUpdate: 'afterkeydown'")--}}
                          {{--!!}--}}
                        {{--<div class="input-group-addon">--}}
                            {{--<b class="">Bags</b>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
        {{--</div>--}}
    </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                <label class="control-label col-sm-4">Remark:</label>
                <div class="col-sm-7">
                    {!!
                        Former::textarea('comment')->raw()

                     !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('container_no') ? ' has-error has-feedback' : '' }}">
                <label for="lot-no" class="control-label col-sm-3">Container No:</label>
                <div class="col-sm-9">
                    {!!
                        Former::text('container_no')->raw()
                     !!}
                    <span style="color: red">{{$errors->first('container_no')}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('seal_no') ? ' has-error has-feedback' : '' }}">
                <label for="seal-no" class="control-label col-sm-3">Seal No:</label>
                <div class="col-sm-9">
                    {!!
                        Former::text('seal_no')->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('vehicle_no') ? ' has-error has-feedback' : '' }}">
                <label for="lot-no" class="control-label col-sm-3">Vehicle No:</label>
                <div class="col-sm-9">
                    {!!
                        Former::text('vehicle_no')->raw()
                     !!}
                    <span style="color: red">{{$errors->first('vehicle_no')}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('invoice_no') ? ' has-error has-feedback' : '' }}">
                <label for="invoice-no" class="control-label col-sm-3">Invoice No:</label>
                <div class="col-sm-9">
                    {!!
                        Former::text('invoice_no')->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="bootstrap-timepicker">
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-3">Start Time:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            {!! Former::text('start_time')->raw() !!}
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
                    <label class="control-label col-sm-3">End Time:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            {!! Former::text('end_time')->raw() !!}
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
            <div class="form-group has-feedback {{ $errors->has('loading_supervisor') ? ' has-error has-feedback' : '' }}">
                <label for="loading_supervisor" class="control-label col-sm-3">Supervisor:</label>
                <div class="col-sm-9">
                    {!!
                         Former::select('supervisor_id')
                         ->addOption(null)
                         ->fromQuery($users,'first_name','id')
                        ->addClass('select')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('shipment_via') ? ' has-error has-feedback' : '' }}">
                <label for="shipment_via" class="control-label col-sm-3">Shipment Area:</label>
                <div class="col-sm-9">
                    {!!
                        Former::radio('shipment_via')->check()
                        ->radios(['0' => 'Local', '1' => 'Global'])->inline()
                        ->check(0)
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group has-feedback {{ $errors->has('photo') ? ' has-error has-feedback' : '' }}">--}}
                {{--<label for="photo" class="control-label col-sm-3">Photo:</label>--}}
                {{--<div class="col-sm-9">--}}
                    {{--{!!--}}
                         {{--Former::text('photo')--}}
                        {{--->raw()--}}
                     {{--!!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-6">
            <label class="control-label col-sm-3">Upload File</label>
            <div class="col-sm-9">
                <input multiple="multiple" name="photo_id[]" type="file">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('grade') ? ' has-error has-feedback' : '' }}">
                <label for="grade" class="control-label col-sm-3">Grade:</label>
                <div class="col-sm-9">
                    {!!
                         Former::text('grade')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('eqc') ? ' has-error has-feedback' : '' }}">
                <label for="eqc" class="control-label col-sm-3">E.Q.C:</label>
                <div class="col-sm-9">
                    {!!
                         Former::text('eqc')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('temperature') ? ' has-error has-feedback' : '' }}">
                <label for="temp" class="control-label col-sm-3">Temperature:</label>
                <div class="col-sm-9">
                    {!!
                         Former::text('temperature')
                        ->raw()
                     !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback {{ $errors->has('location_id') ? ' has-error has-feedback' : '' }}">
                <label for="loading_from" class="control-label col-sm-3">Stuffing Place:</label>
                <div class="col-sm-9">
                    {!!
                         Former::select('location_id')
                         ->addOption(null)
                         ->fromQuery($locations,'first_name','id')
                        ->addClass('select')
                        ->raw()
                     !!}
                    <span style="color: red">{{$errors->first('location_id')}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="text-align: center">Variety</th>
                    <th style="text-align: center">Carton Date</th>
                    <th style="text-align: center">Lot Number</th>
                    <th style="text-align: center">Available Quantity</th>
                    <th style="text-align: center">Quantity</th>
                    <th style="text-align: center">Action</th>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <div class="form-group has-feedback {{ $errors->has('variety') ? ' has-error has-feedback' : '' }}">
                            {{--<label for="lot-no" class="control-label col-sm-5">Variety:</label>--}}
                            <div class="col-sm-12">
                                {!!
                                    Former::select('variety')
                                    ->addOption(null)

                                   ->addClass('select')
                                   ->raw()
                                !!}
                            </div>
                            <span style="color: red">{{$errors->first('variety')}}</span>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div class="form-group has-feedback {{ $errors->has('carton_date') ? ' has-error has-feedback' : '' }}">
                            {{--<label for="carton-date" class="control-label col-sm-3">Carton Date:</label>--}}
                            <div class="col-sm-12">
                                {!!
                                    Former::select('carton_date')
                                    ->addOption(null)
                                   ->addClass('select')
                                   ->raw()
                                !!}
                            </div>
                            <span style="color: red">{{$errors->first('carton_date')}}</span>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div class="form-group has-feedback {{ $errors->has('lot_no') ? ' has-error has-feedback' : '' }}">
                            {{--<label for="lot-no" class="control-label col-sm-3">Lot Number:</label>--}}
                            <div class="col-sm-12">
                                {!!
                                    Former::select('lot_no')
                                    ->addOption(null)
                                   ->addClass('select')
                                   ->raw()
                                !!}
                            </div>
                            <span style="color: red">{{$errors->first('lot_no')}}</span>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div class="form-group has-feedback {{ $errors->has('available_quantity') ? ' has-error has-feedback' : '' }}">
                            {{--<label for="lot-no" class="control-label col-sm-3">Available Quantity:</label>--}}
                            <div class="col-sm-12">
                                {!!
                                    Former::select('available_quantity')
                                    ->addOption(null)
                                   ->addClass('select')
                                   ->raw()
                                !!}
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">
                            {{--<label for="lot-no" class="control-label col-sm-3">Quantity:</label>--}}
                            <div class="col-sm-12">
                                {!!
                                    Former::text('quantity')->raw()
                                 !!}

                            </div>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">
                            <div class="col-sm-9">
                                <button type="button" class="btn pull-right btn-flat" id="allLots" onclick="display()">Shipment</button>
                                {!! $errors->first('vehicle_no', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group has-feedback {{ $errors->has('varity') ? ' has-error has-feedback' : '' }}">--}}
                {{--<label for="varity" class="control-label col-sm-3">Varity:</label>--}}
                {{--<div class="col-sm-9">--}}
                    {{--{!!--}}
                         {{--Former::multiselect('varity')--}}
                         {{--->addOption(null)--}}
                         {{--->fromQuery($varity,'type','id')--}}
                        {{--->addClass('select')--}}
                        {{--->raw()--}}
                     {{--!!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group has-feedback {{ $errors->has('transfer_lot') ? ' has-error has-feedback' : '' }}">--}}
                {{--<label for="transfer_lot" class="control-label col-sm-3">Product:</label>--}}
                {{--<div class="col-sm-9">--}}
                    {{--{!!--}}
                         {{--Former::select('transfer_lot')--}}
                         {{--->addOption(null)--}}
                        {{--->addClass('select')--}}
                        {{--->raw()--}}

                     {{--!!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-3">--}}
            {{--<div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">--}}
                {{--<label for="lot-no" class="control-label col-sm-6">Quantity:</label>--}}
                {{--<div class="col-sm-6">--}}
                    {{--{!!--}}
                        {{--Former::text('quantity')->raw()--}}
                     {{--!!}--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-2">--}}
            {{--<div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">--}}
                {{--<div class="col-sm-9">--}}
                    {{--<button type="button" class="btn pull-right btn-flat" id="allLots" onclick="display()">Transfer</button>--}}
                    {{--{!! $errors->first('vehicle_no', '<span class="help-block">:message</span>') !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover" id="records-table">
                <tr>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Lot</th>
                    <th style="text-align: center">Quantity</th>
                    <th style="text-align: center">Transfer Quantity</th>
                    <th style="text-align: center">Remove</th>
                </tr>
            </table>
        </div>
    </div>
</div>

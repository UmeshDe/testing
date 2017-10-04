<div class="box body">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-lg-3">
                    <div class="bootstrap-timepicker">
                        <div class="form-group has-feedback">
                            <label class="control-label col-sm-5">Carton Date:</label>
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
                <div class="col-lg-3">
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
                <div class="col-lg-3">
                    <div class="form-group has-feedback {{ $errors->has('container_no') ? ' has-error has-feedback' : '' }}">
                        <label for="lot-no" class="control-label col-sm-5">Container No:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::text('container_no')->raw()
                             !!}

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group has-feedback {{ $errors->has('vehicle_no') ? ' has-error has-feedback' : '' }}">
                        <label for="lot-no" class="control-label col-sm-5">Vehicle No:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::text('vehicle_no')->raw()
                             !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group has-feedback {{ $errors->has('loading_from') ? ' has-error has-feedback' : '' }}">
                        <label for="loading_from" class="control-label col-sm-5">From Location:</label>
                        <div class="col-sm-7">
                            {!!
                                 Former::select('loading_from')
                                 ->addOption(null)
                                ->fromQuery($users,'first_name','id')
                                ->addClass('select')
                                ->raw()

                             !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group has-feedback {{ $errors->has('unloading_to') ? ' has-error has-feedback' : '' }}">
                        <label for="unloading_to" class="control-label col-sm-5">To Location:</label>
                        <div class="col-sm-7">
                            {!!
                                 Former::select('unloading_to')
                                 ->addOption(null)
                                ->fromQuery($users,'first_name','id')
                                ->addClass('select')
                                ->raw()

                             !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rows">
        <div class="col-xs-6">
            <div class="box box-primary loading">
                <div class="box-header with-border">
                    <h2 class="box-title">Loading</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-7">
                        <div class="form-group has-feedback {{ $errors->has('transfer_lot') ? ' has-error has-feedback' : '' }}">
                            <label for="transfer_lot" class="control-label col-sm-5">Product Lot & Quantity:</label>
                            <div class="col-sm-7">
                                {!!
                                     Former::select('transfer_lot')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()

                                 !!}
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">
                                <label for="lot-no" class="control-label col-sm-5">Quantity:</label>
                                <div class="col-sm-7">
                                    {!!
                                        Former::text('quantity')->raw()
                                     !!}

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">
                                <label>Transfer</label>
                                <button type="button" class="btn pull-right btn-flat" id="allLots" onclick="display()">Add</button>
                                {!! $errors->first('vehicle_no', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover" id="records-table">
                                <tr>
                                    <th width="20%">Date</th>
                                    <th width="20%">Lot</th>
                                    <th width="30%">Quantity</th>
                                    <th width="23%">Transfer Quantity</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-5">Loading Date:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            {!! Former::text('loading_date')->raw() !!}
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_supervisor') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_supervisor" class="control-label col-sm-5">Loading Supervisor:</label>
                                <div class="col-sm-7">
                                    {!!
                                         Former::select('loading_supervisor')
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
                        <div class="col-lg-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-5">Loading Start Time:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            {!! Former::text('loading_start_time')->raw() !!}
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-5">Loading End Time:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            {!! Former::text('loading_end_time')->raw() !!}
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
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_status') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_status" class="control-label col-sm-5">Loading Status:</label>
                                <div class="col-sm-7">
                                    {!!
                                         Former::select('loading_status')
                                         ->addOption(null)
                                        ->options(['0' => 'Loaded','1' => 'Completed'])
                                        ->addClass('select')
                                        ->raw()
                                     !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_gate_pass_no') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_gate_pass_no" class="control-label col-sm-5">Gate Pass No:</label>
                                <div class="col-sm-7">
                                    {!!
                                        Former::text('loading_gate_pass_no')->raw()
                                     !!}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_remark') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_remark" class="control-label col-sm-5">Remark:</label>
                                <div class="col-sm-7">
                                    {!!
                                        Former::textarea('loading_remark')->raw()
                                        ->rows(10)
                                        ->columns(10)
                                     !!}

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                    <button type="submit" name="button" class="btn btn-primary pull-right btn-flat" value="loading">Save</button>
                    {{--</div>--}}
                </div>

            </div>
        </div>

        {{--@if($transfers->status == 1)--}}
        {{--{{ $("#unloading").hide(); }}--}}

        {{--@endif--}}
        <div class="col-xs-6" id="unloading">
            <div class="box box-primary unloading">
                <div class="box-header with-border">
                    <h2 class="box-title">Unloading</h2>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="records_table">
                        <tr>
                            <th width="20%">Lot</th>
                            <th width="30%">Quantity</th>
                            <th width="30%">Recieved Quantity</th>
                        </tr>
                        <tr>
                        @if(isset($transfers))
                            @foreach($temp as $tem)
                                <tr>
                                    <td width="25%">
                                        {{--<span name="lot_no" id="lot-no"></span>--}}
                                        {{$productlots->lot_no}}
                                        {{--<input type="text" name="product[lot_no][]" value="{{isset($transfer)?$transfer->transferproduct : old('product_id')}}">--}}
                                    </td>
                                    <td width="30%">
                                        {{--<span name="quantity" id="quantity"></span>--}}
                                        {{$tem->quantity}}
                                        {{--<input type="text" name="product[quantity][]">--}}
                                    </td>
                                    <td width="40%">
                                        <input type="text" class="form-control -flip-horizontal" id="product-recieved" name="product[recieved][]" autofocus placeholder="Quantity" value="{{ old('product_recieved') }}">
                                        {!! $errors->first('product_recieved', '<span class="help-block">:message</span>') !!}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-5">Unloading Date:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            {!! Former::text('unloading_date')->raw() !!}
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('unloading_supervisor') ? ' has-error has-feedback' : '' }}">
                                <label for="unloading_supervisor" class="control-label col-sm-5">Unloading Supervisor:</label>
                                <div class="col-sm-7">
                                    {!!
                                         Former::select('unloading_supervisor')
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
                        <div class="col-lg-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-5">Unloading Start Time:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            {!! Former::text('unloading_start_time')->raw() !!}
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-5">Unloading End Time:</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            {!! Former::text('unloading_start_time')->raw() !!}
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
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_status') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_status" class="control-label col-sm-5">Loading Status:</label>
                                <div class="col-sm-7">
                                    {!!
                                         Former::select('loading_status')
                                         ->addOption(null)
                                        ->options(['0' => 'Unoaded','2' => 'Completed'])
                                        ->addClass('select')
                                        ->raw()
                                     !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{ $errors->has('unloading_gate_pass_no') ? ' has-error has-feedback' : '' }}">
                                <label for="unloading_gate_pass_no" class="control-label col-sm-5">Gate Pass No:</label>
                                <div class="col-sm-7">
                                    {!!
                                        Former::text('unloading_gate_pass_no')->raw()
                                     !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-6">
                                <div class="form-group has-feedback {{ $errors->has('unloading_remark') ? ' has-error has-feedback' : '' }}">
                                    <label for="loading_remark" class="control-label col-sm-5">Remark:</label>
                                    <div class="col-sm-7">
                                        {!!
                                            Former::textarea('unloading_remark')->raw()
                                            ->rows(10)
                                            ->columns(10)
                                         !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                    <button type="button" name="button" class="btn btn-primary pull-right btn-flat" value="unloading">Save</button>
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

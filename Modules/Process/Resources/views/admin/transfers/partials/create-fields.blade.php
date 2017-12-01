 <div class="box box-primary">
    <div class="box-header with-border">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('container_no') ? ' has-error has-feedback' : '' }}">
                        <label for="lot-no" class="control-label col-sm-3">Container No:</label>
                        <div class="col-sm-9">
                            {!!
                                Former::text('container_no')->raw()
                             !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('vehicle_no') ? ' has-error has-feedback' : '' }}">
                        <label for="lot-no" class="control-label col-sm-3">Vehicle No:</label>
                        <div class="col-sm-9">
                            {!!
                                Former::text('vehicle_no')->raw()
                             !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('loading_from') ? ' has-error has-feedback' : '' }}">
                        <label for="loading_from" class="control-label col-sm-3">From Location:</label>
                        <div class="col-sm-9">
                            {!!
                                 Former::select('loading_location_id')
                                 ->addOption(null)
                                ->fromQuery($locations,'first_name','id')
                                ->addClass('select')
                                ->raw()
                             !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('unloading_to') ? ' has-error has-feedback' : '' }}">
                        <label for="unloading_to" class="control-label col-sm-3">To Location:</label>
                        <div class="col-sm-9">
                            {!!
                                 Former::select('unloading_location_id')
                                 ->addOption(null)
                                ->fromQuery($locations,'first_name','id')
                                ->addClass('select')
                                ->raw()
                             !!}
                            <a href="#" data-toggle="modal" data-target="#location-modal"  >Add New Location</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('loading_status') ? ' has-error has-feedback' : '' }}">
                        <label for="loading_status" class="control-label col-sm-3">Status:</label>
                        <div class="col-sm-9">
                            {!!
                                 Former::select('status')
                                ->options(['0' => 'Loaded'])
                                ->addClass('select')
                                ->raw()
                             !!}
                         </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                </div>
            </div>
    <div class="col-xs-12" hidden id="loading">
            <div class="box box-primary loading">
                <div class="box-header with-border">
                    <h2 class="box-title">Loading</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                        <div class="form-group has-feedback {{ $errors->has('transfer_lot') ? ' has-error has-feedback' : '' }}">
                            <label for="transfer_lot" class="control-label col-sm-2">Product:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('transfer_lot')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()

                                 !!}
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">
                                <label for="lot-no" class="control-label col-sm-5">Quantity:</label>
                                <div class="col-sm-7">
                                    {!!
                                        Former::text('quantity')->raw()
                                     !!}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-feedback {{ $errors->has('quantity') ? ' has-error has-feedback' : '' }}">
                                <div class="col-sm-9">
                                <button type="button" class="btn pull-right btn-flat" id="allLots" onclick="display()">Transfer</button>
                                {!! $errors->first('vehicle_no', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover" id="records-table">
                                <tr>
                                    <th>Date</th>
                                    <th>Lot</th>
                                    <th>Quantity</th>
                                    <th>Transfer Quantity</th>
                                    <th>Remove</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-4">Date:</label>
                                    <div class="col-sm-8">
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
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_supervisor') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_supervisor" class="control-label col-sm-4">Supervisor:</label>
                                <div class="col-sm-8">
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
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-4">Start Time:</label>
                                    <div class="col-sm-8">
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
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group has-feedback">
                                    <label class="control-label col-sm-4">End Time:</label>
                                    <div class="col-sm-8">
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
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_gate_pass_no') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_gate_pass_no" class="control-label col-sm-4">Gate Pass No:</label>
                                <div class="col-sm-8">
                                    {!!
                                        Former::text('loading_gate_pass_no')->raw()
                                     !!}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{ $errors->has('loading_remark') ? ' has-error has-feedback' : '' }}">
                                <label for="loading_remark" class="control-label col-sm-4">Remark:</label>
                                <div class="col-sm-8">
                                    {!!
                                        Former::textarea('loading_remark')->raw()
                                        ->rows(4)
                                        ->columns(8)
                                     !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="button" class="btn btn-primary pull-right btn-flat" value="loading">Load</button>
                </div>
            </div>
    </div>
</div>
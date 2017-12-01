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
                            ->addOption($transfer->loadinglocation,$transfer->loadinglocation->id)
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
                             ->addOption($transfer->unloadinglocation,$transfer->unloadinglocation->id)
                             ->addClass('select')
                             ->raw()
                         !!}
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
                            ->options(['1' => 'Completed'])
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
    <div class="col-xs-12">
        <div class="box box-primary loading">
            <div class="box-header with-border">
                <h2 class="box-title">Loading</h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover" id="records-table">
                            <tr>
                                <th>Date</th>
                                <th>Lot</th>
                                <th>Quantity</th>

                            </tr>
                            @if(isset($transfer))
                                @foreach($transfer->transfercarton as $transfercarton)
                                    <tr>
                                        <td>
                                            {{$transfercarton->carton->carton_date}}
                                        </td>
                                        <td>
                                            {{$transfercarton->carton->product->lot_no}}
                                        </td>
                                        <td>
                                            {{$transfercarton->quantity}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
                {{--<div class="row">--}}
                {{--<button type="submit" name="button" class="btn btn-primary pull-right btn-flat" value="loading">Load</button>--}}
                {{--</div>--}}
            </div>

        </div>
    </div>

    {{--@if($transfers->status == 1)--}}
    {{--{{ $("#unloading").hide(); }}--}}

    {{--@endif--}}
    <div class="col-xs-12" id="unloading">
        <div class="box box-primary unloading">
            <div class="box-header with-border">
                <h2 class="box-title">Unloading</h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover" id="records_table">
                            <tr>
                                <th>Carton Date</th>
                                <th> Lot</th>
                                <th> Quantity</th>
                                <th>Recieved Quantity</th>
                                {{--<th>Lost Carton</th>--}}
                            </tr>

                            @if(isset($transfer))
                                @foreach($transfer->transfercarton as $transfercarton)
                                    <tr>
                                        <td>
                                            {{$transfercarton->carton->carton_date}}
                                        </td>
                                        <td>
                                            <input type="hidden" name="carton[transfer][]" value="{{$transfercarton->id}}" >
                                            <input type="hidden" name="carton[cartonId][]" value="{{$transfercarton->carton->id}}">
                                            {{$transfercarton->carton->product->lot_no}}
                                        </td>
                                        <td>
                                            {{--data-bind ="value: carton[quantity][],valueUpdate: 'afterkeydown'"--}}

                                            <input type="hidden" name="carton[quantity][]" value="{{$transfercarton->quantity}}">
                                            {{$transfercarton->quantity}}
                                        </td>
                                        <td>
                                            {{--data-bind ="value: carton[recieved][],valueUpdate: 'afterkeydown'"--}}
                                            <input type="text" class="form-control -flip-horizontal" id="product-recieved" name="carton[recieved][]" autofocus placeholder="Quantity" value="{{$transfercarton->received_quantity  }}">
                                        </td>
                                        {{--<td>--}}
                                            {{--<input type="text" class="form-control -flip-horizontal" id="lost-carton" name="carton[lost][]" autofocus placeholder="Lost" data-bind ="value: carton[lost][],valueUpdate: 'afterkeydown'">--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group has-feedback">
                                <label class="control-label col-sm-5">Date:</label>
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
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{ $errors->has('unloading_supervisor') ? ' has-error has-feedback' : '' }}">
                            <label for="unloading_supervisor" class="control-label col-sm-5">Supervisor:</label>
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
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group has-feedback">
                                <label class="control-label col-sm-5">Start Time:</label>
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
                    <div class="col-md-6">
                        <div class="bootstrap-timepicker">
                            <div class="form-group has-feedback">
                                <label class="control-label col-sm-5">End Time:</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        {!! Former::text('unloading_end_time')->raw() !!}
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
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{ $errors->has('unloading_remark') ? ' has-error has-feedback' : '' }}">
                            <label for="loading_remark" class="control-label col-sm-5">Remark:</label>
                            <div class="col-sm-7">
                                {!!
                                    Former::textarea('unloading_remark')->raw()
                                    ->rows(4)
                                    ->columns(8)
                                 !!}

                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}
                @if($transfer->status == 1)
                    <button type="submit" name="button" class="btn btn-primary pull-right btn-flat">Update</button>
                    @else
                    <button type="submit" name="button" class="btn btn-primary pull-right btn-flat" value="unloading">Unload</button>
                    @endif
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>

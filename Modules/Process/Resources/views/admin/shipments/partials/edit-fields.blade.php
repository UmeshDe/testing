<div class="box-body">
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
            <div class="form-group has-feedback {{ $errors->has('stuffing_place') ? ' has-error has-feedback' : '' }}">
                <label for="loading_from" class="control-label col-sm-3">Stuffing Place:</label>
                <div class="col-sm-9">
                    {!!
                         Former::select('location_id')
                         ->addOption(null)
                         ->fromQuery($locations,'first_name','id')
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
            <div class="form-group has-feedback {{ $errors->has('transfer_lot') ? ' has-error has-feedback' : '' }}">
                <label for="transfer_lot" class="control-label col-sm-3">Product:</label>
                <div class="col-sm-9">
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
                <label for="lot-no" class="control-label col-sm-6">Quantity:</label>
                <div class="col-sm-6">
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

                </tr>
                {{--@if(isset($shipment))--}}
                    {{--@foreach($shipment->transfercarton as $shipmentcarton)--}}
                        {{--<tr>--}}
                            {{--<td>--}}
                                {{--{{$shipmentcarton->carton->carton_date}}--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--{{$shipmentcarton->carton->product->lot_no}}--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--{{$shipmentcarton->quantity}}--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                {{--@endif--}}
            </table>
        </div>
    </div>
</div>

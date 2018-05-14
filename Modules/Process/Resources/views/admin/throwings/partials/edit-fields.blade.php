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
        <div class="col-lg-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Variety</th>
                    <th>Carton Date</th>
                    <th>Lot Number</th>
                    <th>Thowing Input</th>
                </tr>
                @if(isset($throwing))
                        <tr>
                            <td>
                                {{$throwing->carton->product->fishtype}}
                            </td>
                            <td>
                                {{\App\Libraries\Utils::parseDate($throwing->carton->carton_date)}}
                            </td>
                            <td>
                                {{$throwing->carton->product->lot_no}}
                            </td>
                            <td>
                                {{$throwing->throwing_input}}
                            </td>
                        </tr>
                @endif
            </table>
        </div>
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
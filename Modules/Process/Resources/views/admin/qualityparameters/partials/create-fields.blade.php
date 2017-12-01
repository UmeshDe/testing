<?php
use Carbon\Carbon;
?>


    {{Former::populate($cartons)}}
    {{Former::populateField('lot_no',$cartons->product->lot_no)}}
    {{Former::populateField('carton_date',\Carbon\Carbon::parse($cartons->carton_date)->format(PHP_DATE_FORMAT))}}
    {{Former::populateField('lot_no',$cartons->product->lot_no)}}


 @if(isset($cartons->qualitycheck))
    {{Former::populateField('inspection_date',\App\Libraries\Utils::parseDate($cartons->qualitycheck->inspection_date))}}
    {{Former::populateField('supervisor_id',$cartons->qualitycheck->supervisor_id)}}
    {{Former::populateField('kind_id',$cartons->qualitycheck->kind_id)}}
    {{Former::populateField('moisture',$cartons->qualitycheck->moisture)}}
    {{Former::populateField('kamaboko_hw',$cartons->qualitycheck->kamaboko_hw)}}
    {{Former::populateField('ashi',$cartons->qualitycheck->ashi)}}
    {{Former::populateField('contam',$cartons->qualitycheck->contam)}}
    {{Former::populateField('ph',$cartons->qualitycheck->ph)}}
    {{Former::populateField('grade_id',$cartons->qualitycheck->grade_id)}}
    {{Former::populateField('suwari_work_force',$cartons->qualitycheck->suwari_work_force)}}
    {{Former::populateField('suwari_length',$cartons->qualitycheck->suwari_length)}}
    {{Former::populateField('suwari_gel_strength',$cartons->qualitycheck->suwari_gel_strength)}}
    {{Former::populateField('work_force',$cartons->qualitycheck->work_force)}}
    {{Former::populateField('length',$cartons->qualitycheck->length)}}
    {{Former::populateField('gel_strength',$cartons->qualitycheck->gel_strength)}}
@endif
<div class="box box-primary" xmlns="http://www.w3.org/1999/html">
    <div class="box-header with-border">
        <h2 class="box-title"></h2>
        <div class="col-md-4">
        <div class="bootstrap-timepicker">
            <div class="form-group has-feedback">
                <label class="control-label col-sm-5">Product Date:</label>

                <div class="col-sm-7" style="padding-top: 7px;margin-bottom :1px">
                    <div class="input-group">
                        {!! Former::hidden('product_date')->raw() !!}
                        <span id="product-date" data-text="lot_no">{{Carbon::parse($cartons->product->product_date)->format(PHP_DATE_FORMAT)}}</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group has-feedback {{ $errors->has('lot_no') ? ' has-error has-feedback' : '' }}">
            <label for="lot-no" class="control-label col-sm-5">Lot No:</label>
            <div class="col-sm-7" style="padding-top: 7px ; margin-bottom :1px">
                {!!
                    Former::hidden('lot_no')->raw()
                 !!}
                <span class="col-sm-7" style="width: 100%" data-text="lot_no">{{$cartons->product->lot_no}}</span>
            </div>
        </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback {{ $errors->has('inspection_date') ? ' has-error has-feedback' : '' }}">
                <label for="inspection-date" class="control-label col-sm-5">Inspection Date:</label>
                <div class="col-sm-7" style="margin-bottom :1px">
                    <div class="input-group">
                        {!! Former::text('inspection_date')->raw() !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    {{--<span class="col-sm-7" style="width: 100%" data-text="lot_no">{{$cartons->product->lot_no}}</span>--}}
                </div>
            </div>
        </div>
        {{--<div class="box-tools pull-right">--}}
            {{--<button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>--}}
        {{--</div>--}}
    </div>
    <div class="box-body">
    <div class="col-xs-4">
        <div class="bootstrap-timepicker">
            <div class="form-group has-feedback">
                <label class="control-label col-sm-5">Carton Date:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('carton_date')->raw() !!}
                        {!! Former::hidden('id') !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group has-feedback {{ $errors->has('kind_id') ? ' has-error has-feedback' : '' }}">
            <label for="kind_id" class="control-label col-sm-5">Kind:</label>
            <div class="col-sm-7">
                {!!
                     Former::select('kind_id')
                     ->addOption(null)
                    ->fromQuery($kinds,'kind','id')
                    ->addClass('select')
                    ->raw()
                 !!}
            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('supervisor_id') ? ' has-error has-feedback' : '' }}">
            <label for="supervisor_id" class="control-label col-sm-5">Supervisor:</label>
            <div class="col-sm-7">
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
    <div class="col-xs-4">
        <div class="form-group has-feedback {{ $errors->has('moisture') ? ' has-error has-feedback' : '' }}">
            <label for="moisture" class="control-label col-sm-5">Moisture:</label>
            <div class="col-sm-7">
                {!!
                    Former::text('moisture')->raw()
                 !!}

            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('kamaboko_hw') ? ' has-error has-feedback' : '' }}">
            <label for="kamaboko-hw" class="control-label col-sm-5">KAMABOKO HW:</label>
            <div class="col-sm-7">
                {!!
                    Former::text('kamaboko_hw')->raw()
                 !!}

            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('ashi') ? ' has-error has-feedback' : '' }}">
            <label for="ashi" class="control-label col-sm-5">ASHI:</label>
            <div class="col-sm-7">
                {!!
                    Former::text('ashi')->raw()
                 !!}

            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group has-feedback {{ $errors->has('contam') ? ' has-error has-feedback' : '' }}">
            <label for="contam" class="control-label col-sm-5">CONTAM:</label>
            <div class="col-sm-7">
                {!!
                    Former::text('contam')->raw()
                 !!}
            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('ph') ? ' has-error has-feedback' : '' }}">
            <label for="contam" class="control-label col-sm-5">PH:</label>
            <div class="col-sm-7">
                {!!
                    Former::text('ph')->raw()
                 !!}
            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('grade') ? ' has-error has-feedback' : '' }}">
            <label for="kind_id" class="control-label col-sm-5">Grade:</label>
            <div class="col-sm-7">
                {!!
                     Former::select('grade_id')
                     ->addOption(null)
                    ->fromQuery($grades,'grade','id')
                    ->addClass('select')
                    ->raw()

                 !!}
            </div>
        </div>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary standard">
            <div class="box-header with-border">
                <h3 class="box-title">STANDERD</h3>
            </div>
            <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('workforce') ? ' has-error has-feedback' : '' }}">
                    <label for="workforce" class="control-label col-sm-4">Work Force:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('work_force')->data_bind("value: work_force,valueUpdate: 'afterkeydown'")->raw()
                         !!}
                    </div>
                </div>
                <div class="form-group has-feedback {{ $errors->has('length') ? ' has-error has-feedback' : '' }}">
                    <label for="length" class="control-label col-sm-4">Length:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('length')->data_bind("value: length,valueUpdate: 'afterkeydown'")->raw()
                         !!}
                    </div>
                </div>
                <div class="form-group has-feedback {{ $errors->has('gel_strength') ? ' has-error has-feedback' : '' }}">
                    <label for="gel_strength" class="control-label col-sm-4">Gel Strength:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('gel_strength')->data_bind("value: gel_strength,valueUpdate: 'afterkeydown'")->raw()
                         !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="box box-primary suwari">
            <div class="box-header with-border">
                <h3 class="box-title">SUWARI</h3>
            </div>
            <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('suwari_work_force') ? ' has-error has-feedback' : '' }}">
                    <label for="suwari_work_force" class="control-label col-sm-4">20% Work Force:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('suwari_work_force')->data_bind("value: suwari_work_force,valueUpdate: 'afterkeydown'")->raw()
                         !!}
                    </div>
                </div>
                <div class="form-group has-feedback {{ $errors->has('suwari_length') ? ' has-error has-feedback' : '' }}">
                    <label for="suwari_length" class="control-label col-sm-4">20% Length:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('suwari_length')->data_bind("value: suwari_length,valueUpdate: 'afterkeydown'")->raw()
                         !!}
                    </div>
                </div>
                <div class="form-group has-feedback {{ $errors->has('suwari_gel_strength') ? ' has-error has-feedback' : '' }}">
                    <label for="suwari_gel_strength" class="control-label col-sm-4">20% Gel Strength:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('suwari_gel_strength')->data_bind("value: suwari_gel_strength,valueUpdate: 'afterkeydown'")->raw()
                         !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{--</div>--}}



<?php
use Carbon\Carbon;
?>


    {{Former::populate($cartons)}}
    {{Former::populateField('lot_no',$cartons->product->lot_no)}}
    {{Former::populateField('carton_date',\Carbon\Carbon::parse($cartons->carton_date)->format(PHP_DATE_FORMAT))}}
    {{Former::populateField('lot_no',$cartons->product->lot_no)}}
    {{Former::populateField('kind_id',$cartons->product->fish_type)}}

 @if(isset($cartons->qualitycheck))
    {{Former::populateField('inspection_date',\App\Libraries\Utils::parseDate($cartons->qualitycheck->inspection_date))}}
    {{Former::populateField('supervisor_id',$cartons->qualitycheck->supervisor_id)}}
    {{Former::populateField('w1',$cartons->qualitycheck->w1)}}
    {{Former::populateField('w2',$cartons->qualitycheck->w2)}}
    {{Former::populateField('w3',$cartons->qualitycheck->w3)}}
    {{Former::populateField('w4',$cartons->qualitycheck->w4)}}
    {{Former::populateField('w5',$cartons->qualitycheck->w5)}}
    {{Former::populateField('l1',$cartons->qualitycheck->l1)}}
    {{Former::populateField('l2',$cartons->qualitycheck->l2)}}
    {{Former::populateField('l3',$cartons->qualitycheck->l3)}}
    {{Former::populateField('l4',$cartons->qualitycheck->l4)}}
    {{Former::populateField('l5',$cartons->qualitycheck->l5)}}
    {{Former::populateField('sw1',$cartons->qualitycheck->sw1)}}
    {{Former::populateField('sw2',$cartons->qualitycheck->sw2)}}
    {{Former::populateField('sw3',$cartons->qualitycheck->sw3)}}
    {{Former::populateField('sw4',$cartons->qualitycheck->sw4)}}
    {{Former::populateField('sw5',$cartons->qualitycheck->sw5)}}
    {{Former::populateField('sl1',$cartons->qualitycheck->sl1)}}
    {{Former::populateField('sl2',$cartons->qualitycheck->sl2)}}
    {{Former::populateField('sl3',$cartons->qualitycheck->sl3)}}
    {{Former::populateField('sl4',$cartons->qualitycheck->sl4)}}
    {{Former::populateField('sl5',$cartons->qualitycheck->sl5)}}
    {{Former::populateField('qcr_pageno',$cartons->qualitycheck->qcr_pageno)}}
    {{Former::populateField('ic_id',$cartons->qualitycheck->ic_id)}}
    {{Former::populateField('moisture',$cartons->qualitycheck->moisture)}}
    {{Former::populateField('machine_moisture',$cartons->qualitycheck->machine_moisture)}}
    {{Former::populateField('kamaboko_hw',$cartons->qualitycheck->kamaboko_hw)}}
    {{Former::populateField('machine_kamaboko_hw',$cartons->qualitycheck->machine_kamaboko_hw)}}
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
            <div class="form-group has-feedback">
                <label class="control-label col-sm-5">Carton Date:</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        {!! Former::text('carton_date')->raw()
                         ->readonly()
                         !!}
                        {!! Former::hidden('id') !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
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

        <div class="form-group has-feedback {{ $errors->has('kind_id') ? ' has-error has-feedback' : '' }}">
            <label for="kind_id" class="control-label col-sm-5">Variety:</label>
            <div class="col-sm-7">
                {!!
                     Former::select('kind_id')
                     ->disabled()
                     ->addOption(null)
                    ->fromQuery($kinds,'type','id')
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
                    ->fromQuery($supervisor,'first_name','id')
                    ->addClass('select')
                    ->raw()
                 !!}
            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group has-feedback {{ $errors->has('ashi') ? ' has-error has-feedback' : '' }}">
            <label for="ashi" class="control-label col-sm-5">ASHI:</label>
            <div class="col-sm-7">
                {!!
                    Former::text('ashi')->raw()
                 !!}

            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('ic_id') ? ' has-error has-feedback' : '' }}">
            <label for="ic_id" class="control-label col-sm-5">Internal Code:</label>
            <div class="col-sm-7">
                {!!
                    Former::select('ic_id')
                    ->addOption(null)
                    ->fromQuery($internalcode ,'internal_code','id')
                    ->addClass('select')
                    ->raw()
                 !!}

            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('qcr_pageno') ? ' has-error has-feedback' : '' }}">
            <label for="qcr_pageno" class="control-label col-sm-5">QCR Page:</label>
            <div class="col-sm-7">
                {!!
                     Former::text('qcr_pageno')
                    ->raw()
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
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Machine</h3>
                </div>
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('machine_moisture') ? ' has-error has-feedback' : '' }}">
                        <label for="machine_moisture" class="control-label col-sm-5">Moisture:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::text('machine_moisture')->raw()
                             !!}

                        </div>
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('machine_kamaboko_hw') ? ' has-error has-feedback' : '' }}">
                        <label for="machine_kamaboko_hw" class="control-label col-sm-5">KAMABOKO HW:</label>
                        <div class="col-sm-7">
                            {!!
                                Former::text('machine_kamaboko_hw')->raw()
                             !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Supervisor</h3>
                </div>
                <div class="box-body">
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
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{ $errors->has('w1') ? ' has-error has-feedback' : '' }}">
                            <label for="w1" class="control-label col-sm-2">W1:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('w1')->data_bind("value: w1,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('w2') ? ' has-error has-feedback' : '' }}">
                            <label for="w2" class="control-label col-sm-2">W2:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('w2')->data_bind("value: w2,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('w3') ? ' has-error has-feedback' : '' }}">
                            <label for="w3" class="control-label col-sm-2">W3:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('w3')->data_bind("value: w3,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('w4') ? ' has-error has-feedback' : '' }}">
                            <label for="w4" class="control-label col-sm-2">W4:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('w4')->data_bind("value: w4,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('w5') ? ' has-error has-feedback' : '' }}">
                            <label for="workforce" class="control-label col-sm-2">W5:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('w5')->data_bind("value: w5,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('workforce') ? ' has-error has-feedback' : '' }}">
                            <label for="workforce" class="control-label col-sm-2">WF:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('work_force')->data_bind("value: work_force,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{ $errors->has('l1') ? ' has-error has-feedback' : '' }}">
                            <label for="l1" class="control-label col-sm-2">L1:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('l1')->data_bind("value: l1,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('l2') ? ' has-error has-feedback' : '' }}">
                            <label for="l2" class="control-label col-sm-2">L2:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('l2')->data_bind("value: l2,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('l3') ? ' has-error has-feedback' : '' }}">
                            <label for="l3" class="control-label col-sm-2">L3:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('l3')->data_bind("value: l3,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('l4') ? ' has-error has-feedback' : '' }}">
                            <label for="l4" class="control-label col-sm-2">L4:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('l4')->data_bind("value: l4,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('l5') ? ' has-error has-feedback' : '' }}">
                            <label for="l5" class="control-label col-sm-2">L5:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('l5')->data_bind("value: l5,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('length') ? ' has-error has-feedback' : '' }}">
                            <label for="length" class="control-label col-sm-2">L:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('length')->data_bind("value: length,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback {{ $errors->has('gel_strength') ? ' has-error has-feedback' : '' }}">
                            <label for="gel_strength" class="control-label col-sm-4">Gel Strength:</label>
                            <div class="col-sm-8">
                                {!!
                                    Former::text('gel_strength')->data_bind("value: gel_strength,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
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
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{ $errors->has('sw1') ? ' has-error has-feedback' : '' }}">
                            <label for="sw1" class="control-label col-sm-2">W1:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sw1')->data_bind("value: sw1,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sw2') ? ' has-error has-feedback' : '' }}">
                            <label for="sw2" class="control-label col-sm-2">W2:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sw2')->data_bind("value: sw2,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sw3') ? ' has-error has-feedback' : '' }}">
                            <label for="sw3" class="control-label col-sm-2">W3:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sw3')->data_bind("value: sw3,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sw4') ? ' has-error has-feedback' : '' }}">
                            <label for="sw4" class="control-label col-sm-2">W4:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sw4')->data_bind("value: sw4,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sw5') ? ' has-error has-feedback' : '' }}">
                            <label for="sw5" class="control-label col-sm-2">W5:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sw5')->data_bind("value: sw5,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('suwari_work_force') ? ' has-error has-feedback' : '' }}">
                            <label for="suwari_work_force" class="control-label col-sm-2">20% WF:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('suwari_work_force')->data_bind("value: suwari_work_force,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{ $errors->has('sl1') ? ' has-error has-feedback' : '' }}">
                            <label for="sl1" class="control-label col-sm-2">L1:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sl1')->data_bind("value: sl1,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sl2') ? ' has-error has-feedback' : '' }}">
                            <label for="sl2" class="control-label col-sm-2">L2:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sl2')->data_bind("value: sl2,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sl3') ? ' has-error has-feedback' : '' }}">
                            <label for="sl3" class="control-label col-sm-2">L3:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sl3')->data_bind("value: sl3,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sl4') ? ' has-error has-feedback' : '' }}">
                            <label for="sl4" class="control-label col-sm-2">L4:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sl4')->data_bind("value: sl4,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('sl5') ? ' has-error has-feedback' : '' }}">
                            <label for="sl5" class="control-label col-sm-2">L5:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('sl5')->data_bind("value: sl5,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('suwari_length') ? ' has-error has-feedback' : '' }}">
                            <label for="suwari_length" class="control-label col-sm-2">20% L:</label>
                            <div class="col-sm-10">
                                {!!
                                    Former::text('suwari_length')->data_bind("value: suwari_length,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback {{ $errors->has('suwari_gel_strength') ? ' has-error has-feedback' : '' }}">
                            <label for="suwari_gel_strength" class="control-label col-sm-4">20% Gel Strength:</label>
                            <div class="col-sm-8">
                                {!!
                                    Former::text('suwari_gel_strength')->data_bind("value: suwari_gel_strength,valueUpdate: 'afterkeydown'")->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{--</div>--}}



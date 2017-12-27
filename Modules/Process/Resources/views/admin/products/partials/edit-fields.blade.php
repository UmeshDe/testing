{{--<div class="box box-primary">--}}
    {{--<div class="box-header with-border">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">ApprovalNo:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<select class="itemName dropdown" id="itemName20" name="approval_no">--}}
                            {{--<option></option>--}}
                            {{--@foreach($approvalnumbers as $approvalnumber)--}}
                                {{--@if(isset($product))--}}
                                    {{--@if($approvalnumber->id == $product->approval_no)--}}
                                {{--<option value="{{$approvalnumber->id}}" selected="true">{{$approvalnumber->app_number}}</option>--}}
                                        {{--@else--}}
                                   {{--<option value="{{$approvalnumber->id}}">{{$approvalnumber->app_number}}</option>--}}
                                        {{--@endif--}}
                                {{--@else--}}
                                    {{--<option value="{{$approvalnumber->id}}">{{$approvalnumber->app_number}}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                        {{--<input type="text" class="form-control -flip-horizontal" id="type-cartons"--}}
                               {{--name="approval_no" autofocus placeholder="Approval Number" value="{{isset($product)?$product->approval_no : old('approval_no') }}">--}}
                        {{--{!! $errors->first('approval_no', '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                    {{--<div class="form-group has-feedback {{ $errors->has('po_no') ? ' has-error has-feedback' : '' }}">--}}
                        {{--<label for="type-name" class="control-label col-sm-3">PO No:</label>--}}
                        {{--<div class="col-sm-9">--}}
                            {{--<input type="text" class="form-control -flip-horizontal" id="type-cartons" name="po_no" autofocus placeholder="PO Number" value="{{$product->po_no}}">--}}
                            {{--{!! $errors->first('po_no', '<span class="help-block">:message</span>') !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="bootstrap-timepicker">--}}
                    {{--<div class="form-group has-feedback">--}}
                        {{--<label class="control-label col-sm-5">{{trans('production::products.productdate')}}:</label>--}}
                        {{--<div class="col-sm-7">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" name="product_date" class="form-control datepicker" data-provide="datepicker" id="datepicker" value="{{$product->product_date }}">--}}
                                {{--<div class="input-group-addon">--}}
                                    {{--<i class="fa fa-clock-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.input group -->--}}
                    {{--</div>--}}
                    {{--<!-- /.form group -->--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="bootstrap-timepicker">--}}
                    {{--<div class="form-group has-feedback">--}}
                        {{--<label class="control-label col-sm-3">CartonDate:</label>--}}
                        {{--<div class="col-sm-9">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" name="carton_date" class="form-control datepicker"--}}
                                       {{--id="timepicker"--}}
                                       {{--value="{{$product->carton_date}}">--}}

                                {{--<div class="input-group-addon">--}}
                                    {{--<i class="fa fa-clock-o"></i>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.input group -->--}}
                    {{--</div>--}}
                    {{--<!-- /.form group -->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('lot_no') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">Lot No:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" class="form-control -flip-horizontal" id="type-cartons" name="lot_no"--}}
                               {{--autofocus--}}
                               {{--placeholder="Lot Number" value="{{$product->lot_no}}">--}}
                        {{--{!! $errors->first('lot_no', '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('production_slab') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">Slab:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" class="form-control -flip-horizontal" id="type-slab" name="production_slab"--}}
                               {{--onkeyup="calculateCarton()"--}}
                               {{--autofocus placeholder="Enter Production Slab in Kg" value="{{$product->product_slab }}">--}}
                        {{--{!! $errors->first('production_slab', '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">CartonNo.</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" class="form-control" id="no-of-cartons" name="no_of_cartons"--}}
                               {{--autofocus placeholder="Enter Cartons" value="{{$product->no_of_cartons}}">--}}
                        {{--{!! $errors->first('no_of_cartons', '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('rejected') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">Rejected:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" class="form-control -flip-horizontal" id="type-rejected" name="rejected"--}}
                               {{--onkeyup="myFunction()"--}}
                               {{--autofocus--}}
                               {{--placeholder="Enter Cartons" value="{{$product->rejected}}">--}}
                        {{--{!! $errors->first('rejected', '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('loose') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">Loose:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" class="form-control -flip-horizontal" id="type-loose" name="loose"--}}
                               {{--autofocus--}}
                               {{--placeholder="Enter Cartons" value="{{$product->loose }}">--}}
                        {{--{!! $errors->first('loose', '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name"--}}
                           {{--class="control-label col-sm-3">{{trans('production::products.fishtype')}}:</label>--}}
                    {{--{!! $errors->first('fish_type', '<span class="help-block">:message</span>') !!}--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<select class="itemName dropdown" id="itemName10" name="fish_type">--}}
                            {{--<option></option>--}}
                            {{--@foreach($fishtypes as $fishtype)--}}
                                {{--@if(isset($product))--}}
                                    {{--@if($fishtype->id == $product->fish_type)--}}
                                {{--<option value="{{$fishtype->id}}" selected="true">{{$fishtype->type}}</option>--}}
                                        {{--@else--}}
                                        {{--<option value="{{$fishtype->id}}">{{$fishtype->type}}</option>--}}
                                    {{--@endif--}}
                                {{--@else--}}
                                    {{--<option value="{{$fishtype->id}}">{{$fishtype->type}}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('bag_color') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="type-name" class="control-label col-sm-3">Bag Color:</label>--}}
                    {{--{!! $errors->first('bag_color', '<span class="help-block">:message</span>') !!}--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<select class="itemName dropdown" id="itemName11" name="bag_color">--}}
                            {{--<option></option>--}}
                            {{--@foreach($bagcolors as $bagcolor)--}}
                                {{--@if(isset($product))--}}
                                    {{--@if($bagcolor->id == $product->bag_color)--}}
                                {{--<option value="{{$bagcolor->id}}" selected="true">{{$bagcolor->color}}</option>--}}
                                    {{--@else--}}
                               {{--<option value="{{$bagcolor->id}}">{{$bagcolor->color}}</option>--}}
                                    {{--@endif--}}
                                    {{--@else--}}
                                {{--<option value="{{$bagcolor->id}}">{{$bagcolor->color}}</option>--}}
                                        {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('carton_type') ? 'has-erro has-feedback' : '' }}">--}}
                    {{--<label for="type-remark"--}}
                           {{--class="control-label col-sm-4">{{ trans('production::products.cartontype') }}:</label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<select class="itemName dropdown" id="itemName17" name="carton_type">--}}
                            {{--<option></option>--}}
{{--                            @foreach($cartontypes as $cartontype)--}}
{{--                                @if(isset($product)--}}
                            {{--@foreach($cartontypes as $cartontype)--}}
                                {{--@if(isset($product))--}}
                                    {{--@if($cartontype->id == $product->carton_type)--}}
                                        {{--<option value="{{$cartontype->id}}" selected="true">{{$cartontype->type}}</option>--}}
                                    {{--@else--}}
                                        {{--<option value="{{$cartontype->id}}">{{$cartontype->type}}</option>--}}
                                    {{--@endif--}}
                                {{--@else--}}
                                    {{--<option value="{{$cartontype->id}}">{{$cartontype->type}}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('remark') ? 'has-erro has-feedback' : '' }}">--}}
                    {{--<label for="type-remark"--}}
                           {{--class="control-label col-sm-3">{{ trans('production::products.remark') }}:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="text" class="form-control" id="type-remark" name="remark" autofocus--}}
                               {{--placeholder="Remark"--}}
                               {{--value="{{$product->remark}}">--}}
                        {{--{!! $errors->first('remark' , '<span class="help-block">:message</span>') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label class="control-label col-sm-3">Location:</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--                        <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">--}}
                        {{--<select class="address dropdown" id="location-id" name="location_id">--}}
                            {{--<option></option>--}}
                            {{--@foreach($locations as $location)--}}
                                {{--@if(isset($product))--}}
                                    {{--@if($location->id == $productlocationId);--}}
                                        {{--<option value="{{$location->id}}" selected="true">{{$location->name."-".$location->location."-".$location->sublocation}}</option>--}}
                                    {{--@else--}}
                                        {{--<option value="{{$location->id}}">{{$location->name."-".$location->location."-".$location->sublocation}}</option>--}}
                                    {{--@endif--}}
                                {{--@else--}}
                                    {{--<option value="{{$location->id}}">{{$location->name."-".$location->location."-".$location->sublocation}}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                        {{--</div>--}}
                        {{--<a href="#" data-toggle="modal" data-target="#modalForm" onclick="createLocation()" >Add New Location</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-2">--}}
                {{--<a href="#" data-toggle="modal" data-target="#modalForm" >Add New Location</a>--}}
                {{--<button type="button" id="btn" class="btn btn-info pull-right" data-toggle="modal"--}}
                        {{--data-target="#modalForm" onclick="createLocation()">Add New Location--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group has-feedback {{ $errors->has('codes') ? 'has-erro has-feedback' : '' }}">--}}
                    {{--<label for="type-remark" class="control-label col-sm-2">Codes:</label>--}}
                    {{--@foreach($codemaster as $codes)--}}
                        {{--                        @if ($codemaster->is_parent == 0)--}}
                        {{--<span value="{{$codes->id}}">{{$codes->code}}</span>--}}
                        {{--<select class="codemaster dropdown" id="itemName14" name="codes">--}}
                            {{--<option></option>--}}
                            {{--@foreach($multiplecodes as $code)--}}
                                {{--@foreach($code as $samecode)--}}
                                    {{--@if ($codes->id == $samecode->is_parent)--}}
                                        {{--@if(isset($product))--}}
                                        {{--<option value="{{$samecode->id}}" selected="true">{{$samecode->code}}</option>--}}
                                            {{--@else--}}
                                            {{--<option value="{{$samecode->id}}">{{$samecode->code}}</option>--}}
                                            {{--@endif--}}
                                        {{--@else--}}
{{--                                       <option value="{{$samecode->id}}">{{$samecode->code}}</option>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">New Packing</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">ApprovalNo:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('approval_no')
                            ->disabled()
                            ->addOption(null)
                            ->fromQuery($approvalnumbers,'name','id')
                            ->addClass('select')
                            ->raw()
                         !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('po_no') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">PO No:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::text('po_no')->raw()
                            ->readonly()
                         !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('bc') ? ' has-error has-feedback' : '' }}">
                    <label for="type-bc" class="control-label col-sm-5">Buyer Code:</label>
                    <div class="col-sm-7">
                        {!!
                           Former::select('buyercode_id')
                           ->disabled()
                           ->addOption(null)
                           ->fromQuery($buyercode,'buyer_code','id')
                           ->addClass('select')
                           ->raw()
                        !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="bootstrap-timepicker">
                    <div class="form-group has-feedback">
                        <label class="control-label col-sm-5">{{trans('process::products.productdate')}}:</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('product_date')->raw()
                                 ->readonly()
                                 !!}
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">
                    <label for="fish_type" class="control-label col-sm-5">{{trans('process::products.fishtype')}}:</label>
                    <div class="col-sm-7">
                        {!!
                             Former::select('fish_type')
                             ->disabled()
                             ->addOption(null)
                            ->fromQuery($fishtypes,'type','id')
                            ->addClass('select')
                            ->raw()
                         !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('bag_color') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Bag Color:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('bag_color')
                           ->disabled()
                           ->addOption(null)
                           ->fromQuery($bagcolors,'color','id')
                           ->addClass('select')
                           ->raw()
                        !!}

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                {!!  Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 5, 'small' => 3]) !!}
                {!! Former::text('lot_no')
                ->readonly()
                          !!}
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                    <label for="product_slab" class="control-label col-sm-5">Slab:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('product_slab')->data_bind("value: product_slab,valueUpdate: 'afterkeydown'")->raw()
                            ->readonly()
                            !!}

                            <div class="input-group-addon">
                                <b class="">Kg</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('no_of_cartons') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">CartonNo:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('no_of_cartons')->data_bind('value: no_of_cartons')->raw()
                             ->readonly()
                             !!}
                            <div class="input-group-addon">
                                <b class="">Cartons</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--@if($product->human_error_slab == null && $product->rejected == null && $product)--}}
        {{--@endif--}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('diff_in_kg') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Diff In Kg:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('diff_in_kg')->data_bind('value: diff_in_kg')->raw()
                            ->readonly()
                            !!}
                            <div class="input-group-addon">
                                <b class="">Kg</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('remark') ? 'has-erro has-feedback' : '' }}">
                    <label for="remark" class="control-label col-sm-5">{{ trans('process::products.remark') }}:</label>
                    <div class="col-sm-7">
                        {!! Former::text('remark')->raw()
                         ->readonly()
                         !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error has-feedback' : '' }}">
                    <label class="control-label col-sm-3">Location:</label>
                    <div class="col-sm-8">
                        {!!
                             Former::select('location_id')
                             ->addOption(null)
                            ->fromQuery($locations,'name','id')
                            ->addClass('select')
                            ->raw()
                         !!}
                        <a href="#" data-toggle="modal" data-target="#location-modal"  >Add New Location</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="bootstrap-timepicker">
                    <div class="form-group has-feedback">
                        <label class="control-label col-sm-5">CartonDate:</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {!! Former::text('carton_date')->raw()
                                 !!}
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('carton_type') ? 'has-erro has-feedback' : '' }}">
                    <label for="carton_type" class="control-label col-sm-5">{{ trans('process::products.cartontype') }}:</label>
                    <div class="col-sm-7">
                        {!!
                           Former::select('carton_type')
                           ->addOption(null)
                          ->fromQuery($cartontypes,'type','id')
                          ->addClass('select')
                          ->raw()
                       !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('cm') ? 'has-erro has-feedback' : '' }}">
                    <label for="cm" class="control-label col-sm-5">CM:</label>
                    <div class="col-sm-7">
                        {!! Former::text('cm')->raw() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('human_error_slab') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">HumanError Slab:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('human_error_slab')->data_bind("value: human_error_slab,valueUpdate: 'afterkeydown'")->raw() !!}
                            <div class="input-group-addon">
                                <b class="">Bags</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('rejected') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Rejected:</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            {!! Former::text('rejected')->data_bind("value: rejected,valueUpdate: 'afterkeydown'")->raw() !!}
                            <div class="input-group-addon">
                                <b class="">Bags</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('loose') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Loose:</label>
                    <div class="col-sm-7">
                        {!! Former::hidden('loose')->data_bind('value: loose')->raw() !!}
                        <span class="form-control"  style="width:100%" data-bind ='text: loose' />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>













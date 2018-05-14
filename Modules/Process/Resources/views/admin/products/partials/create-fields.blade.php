<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">New Production</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('approval_no') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">EIA No:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('approval_no')
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
                                {!! Former::text('product_date')->raw() !!}
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{ $errors->has('bag_color') ? ' has-error has-feedback' : '' }}">
                    <label for="type-name" class="control-label col-sm-5">Bag Color:</label>
                    <div class="col-sm-7">
                        {!!
                            Former::select('bag_color')
                            ->addOption(null)
                           ->fromQuery($bagcolors,'color','id')
                           ->addClass('select')
                           ->raw()
                        !!}

                    </div>
                </div>
            </div>
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
        </div>
            <div class="row">
                <div class="col-md-4">
                    {!!  Former::setOption('TwitterBootstrap3.labelWidths', ['small' => 5]) !!}
                    {!! Former::text('lot_no')
                              !!}
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('product_slab') ? ' has-error has-feedback' : '' }}">
                        <label for="product-slab" class="control-label col-sm-5">Slab:</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                {{--<input type="text" name="product_slab" id="product-slab" class="form-control">--}}

                                {!! Former::text('product_slab')->data_bind("value: product_slab,valueUpdate: 'afterkeydown'")->raw()!!}
                                <div class="input-group-addon">
                                    <b class="">Kg</b>
                                        {{$errors->first('product_slab')}}
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('fish_type') ? ' has-error has-feedback' : '' }}">
                        {{--<label for="fish_type" class="control-label col-sm-5">{{trans('process::products.fishtype')}}:</label>--}}
                        <div class="col-sm-12">
                            {!!
                                 Former::select('fish_type')->label('Variety')
                                 ->addOption(null)
                                ->fromQuery($fishtypes,'type','id')
                                ->addClass('select')

                             !!}
                        </div>
                    {{--</div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('remark') ? 'has-erro has-feedback' : '' }}">
                        <label for="remark" class="control-label col-sm-5">{{ trans('process::products.remark') }}:</label>
                        <div class="col-sm-7">
                            {!! Former::text('remark')->raw() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{ $errors->has('cm_id') ? ' has-error has-feedback' : '' }}">
                        <label for="cm" class="control-label col-sm-5">CM:</label>
                        <div class="col-sm-7">
                            {!!
                                 Former::select('cm_id')
                                 ->addOption(null)
                                ->fromQuery($cm,'cm','id')
                                ->addClass('select')
                                ->raw()
                             !!}
                        </div>
                    </div>
                </div>
            </div>
        <hr>
            <div class="row">
                <div class="box-header" style="margin-left: 45%">
                    <h2 class="box-title"><label>Codes</label></h2>
                </div>
                <div class="box-body">
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('fm_id') ? ' has-error has-feedback' : '' }}">
                            <label for="fm_id" class="control-label col-sm-2 codes">FM:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('fm_id')
                                     ->fromQuery($fm,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('i_id') ? ' has-error has-feedback' : '' }}">
                            <label for="i_id" class="control-label col-sm-2 codes">I:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('i_id')
                                     ->fromQuery($i,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('k_id') ? ' has-error has-feedback' : '' }}">
                            <label for="k_id" class="control-label col-sm-2 codes">K:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('k_id')
                                     ->fromQuery($k,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('e_id') ? ' has-error has-feedback' : '' }}">
                            <label for="e_id" class="control-label col-sm-2 codes">E:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('e_id')
                                     ->fromQuery($e,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('t_id') ? ' has-error has-feedback' : '' }}">
                            <label for="t_id" class="control-label col-sm-2 codes">T:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('t_id')
                                     ->fromQuery($t,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('sg_id') ? ' has-error has-feedback' : '' }}">
                            <label for="sg_id" class="control-label col-sm-2 codes">SG:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('sg_id')
                                     ->fromQuery($sg,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('kg_id') ? ' has-error has-feedback' : '' }}">
                            <label for="kg_id" class="control-label col-sm-2 codes">KG:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('kg_id')
                                     ->fromQuery($kg,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('g_id') ? ' has-error has-feedback' : '' }}">
                            <label for="g_id" class="control-label col-sm-2 codes">G:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('g_id')
                                     ->fromQuery($g,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('h_id') ? ' has-error has-feedback' : '' }}">
                            <label for="h_id" class="control-label col-sm-2 codes">H:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('h_id')
                                     ->fromQuery($h,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('rc_id') ? ' has-error has-feedback' : '' }}">
                            <label for="rc_id" class="control-label col-sm-2 codes">RC:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('rc_id')
                                     ->fromQuery($rc,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('mk_id') ? ' has-error has-feedback' : '' }}">
                            <label for="mk_id" class="control-label col-sm-2 codes">MK:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('mk_id')
                                     ->fromQuery($mk,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="box-body">

                    {{--<div class="col-md-3">--}}
                    {{--<div class="form-group has-feedback {{ $errors->has('fr_id') ? ' has-error has-feedback' : '' }}">--}}
                    {{--<label for="fr_id" class="control-label col-sm-2 codes">FR:</label>--}}
                    {{--<div class="col-sm-10">--}}
                    {{--{!!--}}
                    {{--Former::select('fr_id')--}}
                    {{--->fromQuery($fr,'code','id')--}}
                    {{--->addOption(null)--}}
                    {{--->addClass('select')--}}
                    {{--->raw()--}}
                    {{--!!}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('d_id') ? ' has-error has-feedback' : '' }}">
                            <label for="d_id" class="control-label col-sm-2 codes">D:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('d_id')
                                     ->fromQuery($d,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('s_id') ? ' has-error has-feedback' : '' }}">
                            <label for="s_id" class="control-label col-sm-2 codes">S:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('s_id')
                                     ->fromQuery($s,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('a_id') ? ' has-error has-feedback' : '' }}">
                            <label for="a_id" class="control-label col-sm-2 codes">A:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('a_id')
                                     ->fromQuery($a,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('c_id') ? ' has-error has-feedback' : '' }}">
                            <label for="c_id" class="control-label col-sm-2 codes">C:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('c_id')
                                     ->fromQuery($c,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('p_id') ? ' has-error has-feedback' : '' }}">
                            <label for="p_id" class="control-label col-sm-2 codes">P:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('p_id')
                                     ->fromQuery($p,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('b_id') ? ' has-error has-feedback' : '' }}">
                            <label for="b_id" class="control-label col-sm-2 codes">B:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('b_id')
                                      ->fromQuery($b,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('m_id') ? ' has-error has-feedback' : '' }}">
                            <label for="m_id" class="control-label col-sm-2 codes">M:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('m_id')
                                     ->fromQuery($m,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('w_id') ? ' has-error has-feedback' : '' }}">
                            <label for="c_id" class="control-label col-sm-2 codes">W:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('w_id')
                                      ->fromQuery($w,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('q_id') ? ' has-error has-feedback' : '' }}">
                            <label for="q_id" class="control-label col-sm-2 codes">Q:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('q_id')
                                      ->fromQuery($q,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('sc_id') ? ' has-error has-feedback' : '' }}">
                            <label for="sc_id" class="control-label col-sm-2 codes">SC:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('sc_id')
                                     ->fromQuery($sc,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{ $errors->has('lc_id') ? ' has-error has-feedback' : '' }}">
                            <label for="lc_id" class="control-label col-sm-2 codes">LC:</label>
                            <div class="col-sm-10">
                                {!!
                                     Former::select('lc_id')
                                     ->fromQuery($lc,'code','id')
                                     ->addOption(null)
                                    ->addClass('select')
                                    ->raw()
                                 !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










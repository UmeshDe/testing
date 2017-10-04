@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::qualityparameters.title.create qualityparameter') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.process.qualityparameter.index') }}">{{ trans('process::qualityparameters.title.qualityparameters') }}</a></li>
        <li class="active">{{ trans('process::qualityparameters.title.create qualityparameter') }}</li>
    </ol>
@stop

@section('content')

    @if($cartons->qualitycheckdone == 0)

    {{Former::populate($cartons)}}
    {{Former::populateField('lot_no',$cartons->product->lot_no)}}
    @else
    {{Former::populate($cartons)}}
    {{Former::populateField('carton_date',\Carbon\Carbon::parse($cartons->carton_date)->format(PHP_DATE_FORMAT))}}
    {{Former::populateField('lot_no',$cartons->product->lot_no)}}
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
    {{--{{Former::populate($qualityparameter)}}--}}
    {!! Former::horizontal_open()
    ->route('admin.process.qualityparameter.store')
    ->method('POST')
    !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="tab-content">
                @include('partials.form-tab-headers')
                @include('process::admin.qualityparameters.partials.create-fields')
            </div>
                <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.process.qualityparameter.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
            </div>
        </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.process.qualityparameter.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });

        $('#carton_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
        });
    </script>
@endpush

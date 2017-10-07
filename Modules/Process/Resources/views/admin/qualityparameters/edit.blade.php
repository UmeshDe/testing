@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::qualityparameters.title.edit qualityparameter') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.process.qualityparameter.index') }}">{{ trans('process::qualityparameters.title.qualityparameters') }}</a></li>
        <li class="active">{{ trans('process::qualityparameters.title.edit qualityparameter') }}</li>
    </ol>
@stop

@section('content')
    {!! Former::horizontal_open()
   ->route('admin.process.qualityparameter.update',$qualityparameter->id)
   ->method('PUT')
   !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
                @include('process::admin.qualityparameters.partials.create-fields')
        </div>
    </div>

    {{--<div class="box-footer">--}}
        <button type="submit" class="btn btn-primary pull-right btn-flat">{{ trans('core::core.button.update') }}</button>
        <a class="btn btn-danger pull-left btn-flat" href="{{ route('admin.process.qualityparameter.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
    {{--</div>--}}

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
            $('#carton_date').datetimepicker({
                timepicker: false,
                format: '{{PHP_DATE_FORMAT}}',
                value: '{{\Carbon\Carbon::parse($cartons->carton_date)->format(PHP_DATE_FORMAT)}}'
            });

            $('#kind_id').select2();

            $('#grade_id').select2();
        });
    </script>


@endpush

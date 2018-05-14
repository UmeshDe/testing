@extends('layouts.master')

@section('content-header')
    {{--<ol class="breadcrumb">--}}
        {{--<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>--}}
        {{--<li><a href="{{ route('admin.process.repack.index') }}">{{ trans('process::repacks.title.repacks') }}</a></li>--}}
        {{--<li class="active">{{ trans('process::repacks.title.edit repack') }}</li>--}}
    {{--</ol>--}}
@stop

@section('content')

    {!! Former::populate($repack) !!}


    {!! Former::horizontal_open()
       ->route('admin.process.repack.update', $repack->id)
       ->method('PUT')
   !!}

    {{ csrf_field() }}


    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="box box-primary">
                    <div class="box box-header">
                        @include('partials.form-tab-headers')
                        <h4>
                            {{ trans('process::repacks.title.edit repack') }}
                        </h4>
                    </div>
                    <div class="box-body">
                            @include('process::admin.repacks.partials.edit-fields')
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-danger btn-flat" href="{{ route('admin.process.repack.index')}}" style="margin-left: 30%"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%">{{ trans('core::core.button.update') }}</button>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
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
                    { key: 'b', route: "<?= route('admin.process.repack.index') ?>" }
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
    </script>
    <script>
        $('#location_id').select2();
        $('#product').select2();
        $('#fishtype_id').select2();
        $('#bagcolor_id').select2();
        $('#cartontype_id').select2();
        $('#grade_id').select2();


        $('#carton_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
            value : '{{\Carbon\Carbon::parse($repack->carton_date)->format(PHP_DATE_FORMAT)}}'
        });
        $('#repack_date').datetimepicker({
            timepicker:false,
            format:'{{PHP_DATE_FORMAT}}',
            value : '{{\Carbon\Carbon::parse($repack->repack_date)->format(PHP_DATE_FORMAT)}}'
        });

    </script>
@endpush

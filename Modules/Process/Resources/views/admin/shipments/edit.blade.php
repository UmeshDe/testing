@extends('layouts.master')

@section('content-header')
@stop

@section('content')

    {!! Former::populate($shipment) !!}

    {!! Former::horizontal_open()
       ->route('admin.process.shipment.update', $shipment->id)
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
                            {{ trans('process::shipments.title.edit shipment') }}
                        </h4>
                    </div>
                    <div class="body">
                @include('process::admin.shipments.partials.edit-fields')
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-danger btn-flat" href="{{ route('admin.process.shipment.index')}}" style="margin-left: 35%"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 10%"><i class="fa fa-floppy-o" aria-hidden="true"></i>{{ trans('core::core.button.update') }}</button>
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
                    { key: 'b', route: "<?= route('admin.process.shipment.index') ?>" }
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
        $('#varity,#location_id').select2();
        $('#start_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($shipment->start_time)->format(PHP_DATE_TIME_FORMAT)}}'
        });
        $('#end_time').datetimepicker({
            format :'{{PHP_DATE_TIME_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($shipment->end_time)->format(PHP_DATE_TIME_FORMAT)}}'
        });
    </script>
@endpush

@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::qualityparameters.title.create qualityparameter') }}
    </h1>
@stop

@section('content')


    {{--{{Former::populate($qualityparameter)}}--}}
    {!! Former::horizontal_open()
    ->route('admin.process.qualityparameter.store')
    ->method('POST')
    !!}

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
                @include('process::admin.qualityparameters.partials.create-fields')
        </div>
    </div>
    <button type="submit" class="btn btn-primary pull-right btn-flat">{{ trans('core::core.button.create') }}</button>
    <a class="btn btn-danger pull-left btn-flat" href="{{ route('admin.process.qualityparameter.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>

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
            timepicker: false,
            format: '{{PHP_DATE_FORMAT}}',
            value: '{{\Carbon\Carbon::parse($cartons->carton_date)->format(PHP_DATE_FORMAT)}}'
        });

        $('#inspection_date').datetimepicker({
            timepicker: false,
            format: '{{PHP_DATE_FORMAT}}',
            value : new moment(),
        });

        $('#kind_id').select2();

        $('#grade_id').select2();

        $('#supervisor_id').select2();

        $('#ic_id').select2();

        var ViewModel = function(model) {
            var self = this;
            this.suwari_work_force = ko.observable(0);
            this.suwari_length = ko.observable(0);
            this.work_force = ko.observable(0);
            this.length = ko.observable(0);



            this.suwari_gel_strength = ko.computed(function () {
                var value = self.suwari_work_force() * self.suwari_length();
                return (value)?value:0;
            });

            this.gel_strength = ko.computed(function () {
               var value = self.work_force() * self.length();
               return (value)?value:0;
            });
        };
        ko.applyBindings(new ViewModel());




    </script>
@endpush

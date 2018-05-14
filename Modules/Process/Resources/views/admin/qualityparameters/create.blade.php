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
        <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-save"></i>{{ trans('core::core.button.create') }}</button>
        <a class="btn btn-danger pull-left btn-flat" href="{{ route('admin.process.qualityparameter.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
            this.w1 = ko.observable(0);
            this.w2 = ko.observable(0);
            this.w3 = ko.observable(0);
            this.w4 = ko.observable(0);
            this.w5 = ko.observable(0);
            this.l1 = ko.observable(0);
            this.l2 = ko.observable(0);
            this.l3 = ko.observable(0);
            this.l4 = ko.observable(0);
            this.l5 = ko.observable(0);
            this.sw1 = ko.observable(0);
            this.sw2 = ko.observable(0);
            this.sw3 = ko.observable(0);
            this.sw4 = ko.observable(0);
            this.sw5 = ko.observable(0);
            this.sl1 = ko.observable(0);
            this.sl2 = ko.observable(0);
            this.sl3 = ko.observable(0);
            this.sl4 = ko.observable(0);
            this.sl5 = ko.observable(0);


            this.work_force = ko.computed(function () {
                var value = (parseFloat(parseFloat(self.w1()) + parseFloat(self.w2()) + parseFloat(self.w3()) + parseFloat(self.w4()) + parseFloat(self.w5())).toPrecision(4)/5).toPrecision(3);
                return (value)?value:0;
            });
            this.length = ko.computed(function () {
                var value = (parseFloat(parseFloat(self.l1()) + parseFloat(self.l2()) + parseFloat(self.l3()) + parseFloat(self.l4()) + parseFloat(self.l5())).toPrecision(4)/5).toPrecision(3);
                return (value)?value:0;
            });
            this.suwari_work_force = ko.computed(function () {
                var value = (parseFloat(parseFloat(self.sw1()) + parseFloat(self.sw2()) + parseFloat(self.sw3()) + parseFloat(self.sw4()) + parseFloat(self.sw5())).toPrecision(4)/5).toPrecision(3);
                return (value)?value:0;
            });
            this.suwari_length = ko.computed(function () {
                var value = (parseFloat(parseFloat(self.sl1()) + parseFloat(self.sl2()) + parseFloat(self.sl3()) + parseFloat(self.sl4()) + parseFloat(self.sl5())).toPrecision(4)/5).toPrecision(3);
                return (value)?value:0;
            });
            this.suwari_gel_strength = ko.computed(function () {
                var value = self.suwari_work_force() * self.suwari_length();
                return (value)?value.toFixed(2):0;
            });
            this.gel_strength = ko.computed(function () {
               var value = self.work_force() * self.length();
               return (value)?value.toFixed(2):0;
            });
        };
        ko.applyBindings(new ViewModel());




    </script>
@endpush

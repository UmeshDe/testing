@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('process::products.title.edit product') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.process.product.index') }}">{{ trans('process::products.title.products') }}</a></li>
        <li class="active">{{ trans('process::products.title.edit product') }}</li>
    </ol>
@stop

    {!! Theme::script('vendor/admin-lte/plugins/select2/select2.full.js') !!}
    {!! Theme::style('vendor/admin-lte/plugins/select2/select2.min.css') !!}
@section('content')
    {!! Form::open(['route' => ['admin.process.product.update', $product->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            
                @include('partials.form-tab-headers')
            
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('process::admin.products.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

            
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.process.product.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>


            </div> {{-- end nav-tabs-custom --}}

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
                    { key: 'b', route: "<?= route('admin.process.product.index') ?>" }
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
<script type="text/javascript">
    function calculateCarton()
    {
        var productionslab = document.getElementById('type-slab').value;
        var carton = productionslab / 20    ;
        document.getElementById('no-of-cartons').value = carton;
    }

    function myFunction()
    {
        var rejected = document.getElementById('type-rejected').value;
        var noofcartons = document.getElementById('no-of-cartons').value;
        if(rejected % 2 == 0)
        {
            var value = 0;
            var cartonvalue = rejected/2;
            var remainingcartons = noofcartons - cartonvalue;
        }
        else {
            var value = 1;
            var cartonvalue = rejected/2 + 0.5;
            var remainingcartons = noofcartons - cartonvalue;
        }
        document.getElementById('no-of-cartons').value = remainingcartons;
        document.getElementById('type-loose').value = value;
    }
</script>
<script type="text/javascript">
    $('#address-id').select2({
//        width: 100% !important,
        placeholder: 'Select Client',
    });
</script>
<style>
    .address{
        width: 100% !important;
    }
</style>
<script type="text/javascript">

    //    $("#itemName").select2({
    //        placeholder: 'Select an item',
    //        width:'100%',
    //    });
    $("#itemName1").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $("#itemName2").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $("#itemName3").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $("#itemName6").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $("#itemName10").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $("#itemName11").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $("#itemName17").select2({
        placeholder: 'Select an item',
        width:'100%',
    });
    $(".codemaster").select2({
        placeholder: 'Select an item',
        width:'29%',
    });
    $("#location-id").select2({
        placeholder: 'Search Location',
        width : '100%',
    });
    $('#itemName20').select2({
        placeholder: 'Select an item',
        width:'100%',
    });
</script>
@endpush

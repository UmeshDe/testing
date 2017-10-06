@extends('layouts.master')

@section('content-header')
    <div  class="row">
        <div class="col-md-6">
            <h4>    {{ trans('process::products.title.products') }}  </h4>
        </div>
        <div class="col-md-6">
            <h4>
            <a href="{{ route('admin.process.product.create') }}" class="btn btn-primary btn-flat pull-right"
               style="padding: 4px 10px;">
                <i class="fa fa-pencil"></i> {{ trans('process::products.button.create product') }}
            </a>
            </h4>
         </div>
    </div>
    {{--<ol class="breadcrumb">--}}
        {{--<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>--}}
        {{--<li class="active">{{ trans('process::products.title.products') }}</li>--}}
    {{--</ol>--}}
    {{--<div class="btn-group pull-right" style="margin: 0 15px 15px 0;">--}}

    {{--</div>--}}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Lot No</th>
                                <th>Fish Type</th>
                                <th>Bag Color</th>
                                <th>Production Slab</th>
                                <th>No.Of Cartons</th>
                                <th>Rejected</th>
                                <th>Loose</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($products))
                            @foreach ($products as $product)
                            <tr>
                                <td>{{isset($product->product_date)?\Carbon\Carbon::parse($product->product_date)->format(PHP_DATE_FORMAT) : '' }}</td>
                                <td>{{$product->lot_no}}</td>
                                <td>{{$product->fishtype['type']}}</td>
                                <td>{{$product->bagcolor['color']}}</td>
                                <td>{{$product->product_slab}}</td>
                                <td>{{$product->no_of_cartons}}</td>
                                <td>{{$product->rejected}}</td>
                                <td>{{$product->loose}}</td>
                                <td>
                                    <a href="{{ route('admin.process.product.edit', [$product->id]) }}">
                                        {{ $product->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.process.product.edit', [$product->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.process.product.destroy', [$product->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('process::products.title.create product') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.process.product.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush

@extends('layouts.master')

@section('content-header')
    <div  class="row">
        <div class="col-md-6">
            <h4>    {{ trans('process::products.title.packing') }}  </h4>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Production Date</th>
                                <th>Lot No</th>
                                <th>Production Slab</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@if (isset($products))--}}
                                {{--@foreach ($products as $product)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{isset($product->product_date)?\Carbon\Carbon::parse($product->product_date)->format(PHP_DATE_FORMAT) : '' }}</td>--}}
                                        {{--<td>{{$product->lot_no}}</td>--}}
                                        {{--<td>{{$product->product_slab}}</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route('admin.process.product.edit', [$product->id]) }}">--}}
                                                {{--{{ $product->created_at }}--}}
                                            {{--</a>--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--@if($product->packingdone == 0)--}}
                                                {{--<a href="{{ route('admin.process.product.edit', [$product->id]) }}" class="btn btn-default btn-danger"><span style="color:white">Packing Pending</span></a>--}}
                                            {{--@elseif($product->packingdone )--}}
                                                {{--<a href="{{ route('admin.process.product.edit', [$product->id]) }}" class="btn btn-default btn-success"><span style="color:white">Packing Completed</span></a>--}}
                                            {{--@else--}}
                                                {{--<a href="{{ route('admin.process.product.edit', [$product->id]) }}" class="btn btn-default btn-info"><span style="color:white">Packing Completed</span></a>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
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
    $( document ).ready(function() {
        $('.data-table').dataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "bAutoWidth": false,
            "ajax": "{{route('admin.process.product.packingindex')}}",
            "columns": [
                {data: 'product_date'},
                {data: 'lot_no'},
//                    {data:'order_no'},
//                 {data: 'fishtype'},
//                 {data: 'bagcolor'},
                {data: 'product_slab'},
                {data: 'created_at'},
                {data: 'action'}
            ]
        });
    });
</script>
@endpush

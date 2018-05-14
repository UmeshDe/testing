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
                                <th>Production Date</th>
                                <th>Lot No</th>
                                <th>Fish Type</th>
                                <th>Bag Color</th>
                                <th>Production Slab</th>
                                {{--<th>{{ trans('core::core.table.created at') }}</th>--}}
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@if (isset($products))--}}
                            {{--@foreach ($products as $product)--}}
                            {{--<tr>--}}
                                {{--<td>{{isset($product->product_date)?\Carbon\Carbon::parse($product->product_date)->format(PHP_DATE_FORMAT) : '' }}</td>--}}
                                {{--<td>{{$product->lot_no}}</td>--}}
                                {{--<td>{{$product->fishtype['type']}}</td>--}}
                                {{--<td>{{$product->bagcolor['color']}}</td>--}}
                                {{--<td>{{$product->product_slab}}</td>--}}
                                {{--<td>--}}
                                    {{--<a href="{{ route('admin.process.product.edit', [$product->id]) }}">--}}
                                        {{--{{ $product->created_at }}--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<a href="{{ route('admin.process.product.edit', [$product->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>--}}
                                        {{--<button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.process.product.destroy', [$product->id]) }}"><i class="fa fa-trash"></i></button>--}}
                                    {{--</div>--}}
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
            $('.data-table').dataTable({
                "processing": true,
                "serverSide": true,
                "pageLength" : 10,
                "bAutoWidth": false,
                "ajax": "{{route('admin.process.product.index')}}",
                "columns": [
                    {data: 'product_date'},
                    {data: 'lot_no'},
//                    {data:'order_no'},
                    {data: 'fishtype'},
                    {data: 'bagcolor'},
                    {data: 'product_slab'},
                    {data:'action'}
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
@endpush

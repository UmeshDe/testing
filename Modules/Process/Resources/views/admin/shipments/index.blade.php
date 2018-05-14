@extends('layouts.master')

@section('content-header')
    <div  class="row">
        <div class="col-md-6">
            <h4>    {{ trans('process::shipments.title.shipments') }}  </h4>
        </div>
        <div class="col-md-6">
            <h4>
                <a href="{{ route('admin.process.shipment.create') }}" class="btn btn-primary pull-right btn-flat">
                    <i class="fa fa-pencil"></i> {{ trans('process::shipments.button.create shipment') }}
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
                                <th>Invoice No</th>
                                <th>Shipment Date</th>
                                <th>Vehicle No</th>
                                <th>Container No</th>
                                <th>Photo</th>
{{--                                <th>{{ trans('core::core.table.created at') }}</th>--}}
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($shipments)): ?>
                            <?php foreach ($shipments as $shipment): ?>
                            <tr>
                                <td>{{$shipment->invoice_no}}</td>
                                <td>{{isset($shipment->created_at)?\App\Libraries\Utils::parseDate($shipment->created_at) : '' }}</td>
                                <td>{{$shipment->vehicle_no}}</td>
                                <td>{{$shipment->container_no}}</td>
                                <td>
                                   <?php
                                    $shipmentFiles  = app(\Modules\Process\Repositories\ShipmentFileRepository::class)->getByAttributes(['shipment_id' => $shipment->id]);
                                    $fileRepo = app(\Modules\Filemanager\Repositories\FileRepository::class);
                                    foreach ($shipmentFiles as $shipmentFile)
                                        {
                                            $files = $fileRepo->find($shipmentFile->file_id);
                                            echo "<li>". link_to_route('admin.filemanager.file.getFile',$files->filename , [$files->id]) ."</li>";
                                        }

                                    ?>
                                </td>
                                {{--<td>--}}
                                    {{--<a href="{{ route('admin.process.shipment.edit', [$shipment->id]) }}">--}}
                                        {{--{{ $shipment->created_at }}--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.process.shipment.edit', [$shipment->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.process.shipment.destroy', [$shipment->id]) }}"><i class="fa fa-trash"></i></button>
                                        @if($shipment->shipment == 0)
                                        <button class="btn btn-info btn-flat shipment" data-id="{{$shipment->id}}" data-toggle="modal" data-target="#shipment-modal" ><span style="color:white">Confirm Shipped</span></button>
                                        @else
                                        <button class="btn btn-success btn-flat shipment" data-id="{{$shipment->id}}" data-toggle="modal" data-target="#shipment-modal" ><span style="color:white">Shipped</span></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                            </tr>
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
    @include('process::modal.shipment-done')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('process::shipments.title.create shipment') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.process.shipment.create') ?>" }
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
                "sort": false,
                "info": true,
                "autoWidth": true,
                "order": false,
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
    <script>
        $('.shipment').click(function () {
            $("#shipment-modal").find('input[name="shipmentId"]').val($(this).data("id"));
        });
    </script>
@endpush

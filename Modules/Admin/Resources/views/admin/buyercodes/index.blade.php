@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('admin::buyercodes.title.buyercodes') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('admin::buyercodes.title.buyercodes') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="buyercode-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Buyer Name</th>
                                <th>Buyer Code</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($buyercodes)): ?>
                            <?php foreach ($buyercodes as $buyercode): ?>
                            <tr>
                                <td>{{$buyercode->buyer_name}}</td>
                                <td>{{$buyercode->buyer_code}}</td>
                                <td>
                                    <a href="{{ route('admin.admin.buyercode.edit', [$buyercode->id]) }}">
                                        {{ $buyercode->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-buyer_name="{{$buyercode->buyer_name}}" data-buyer_code ="{{$buyercode->buyer_code}}" data-id="{{$buyercode->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.admin.buyercode.destroy', [$buyercode->id]) }}"><i class="fa fa-trash"></i></button>
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
            <div id="update-div" class="box box-primary" hidden>
                <div class="box-header with-border">
                    <h3 class="box-title">Update Buyer Code</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.buyercode.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('buyer_name') ? ' has-error has-feedback' : '' }}">
                        <label for="buyer-name">Buyer Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="buyer-name"  name = "buyer_name" autofocus placeholder="Enter Buyer Name" value="{{ old('buyer_name') }}">
                        {!! $errors->first('buyer_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('buyer_code') ? ' has-error has-feedback' : '' }}">
                        <label for="buyer-code">Buyer Code</label>
                        <input type="text" class="form-control -flip-horizontal" id="buyer-code"  name = "buyer_code" autofocus placeholder="Enter Buyer Code" value="{{ old('buyer_code') }}">
                        {!! $errors->first('buyer_code', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="buyercode_id" id="buyercode-id">
                    <input type="hidden" name="old_buyername" id="old-buyername">
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary pull-left" id="btn-cancel-update">Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-xs-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buyer Code</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.admin.buyercode.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group -flip-horizontal {{ $errors->has('buyer_name') ? ' has-error has-feedback' : '' }}">
                        <label for="buyer-name">Buyer Name</label>
                        <input type="text" class="form-control -flip-horizontal" id="buyer-name"  name = "buyer_name" autofocus placeholder="Enter Buyer Name" value="{{ old('buyer_name') }}">
                        {!! $errors->first('buyer_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group -flip-horizontal {{ $errors->has('buyer_code') ? ' has-error has-feedback' : '' }}">
                        <label for="buyer-code">Buyer Code</label>
                        <input type="text" class="form-control -flip-horizontal" id="buyer-code"  name = "buyer_code" autofocus placeholder="Enter Buyer Code" value="{{ old('buyer_code') }}">
                        {!! $errors->first('buyer_code', '<span class="help-block">:message</span>') !!}
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
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
        <dd>{{ trans('admin::buyercodes.title.create buyercode') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.admin.buyercode.create') ?>" }
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

        $(".category-edit-button").click(function () {

            $("#buyercode-list").hide();

            $("#buyercode-id").val($(this).data("id"));
            $("#old-buyername").val($(this).data("buyer_name"));
            $("#update-form").find('input[name="buyer_name"]').val($(this).data("buyer_name"));
            $("#update-form").find('input[name="buyer_code"]').val($(this).data("buyer_code"));
            $("#update-div").show();
        });

        $("#btn-cancel-update").click(function(event){
            event.preventDefault();
            $("#buyercode-list").show();
            $("#update-div").hide();

        });
    </script>
@endpush

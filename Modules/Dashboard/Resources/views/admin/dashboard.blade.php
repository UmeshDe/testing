@extends('layouts.master')

@section('content-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <h1 class="pull-left">
        {{ trans('dashboard::dashboard.name') }}
    </h1>
    <div class="btn-group pull-right">
        <a class="btn btn-default" id="edit-grid" data-mode="0" href="#">{{ trans('dashboard::dashboard.edit grid') }}</a>
        <a class="btn btn-default" id="reset-grid" href="{{ route('dashboard.grid.reset')  }}">{{ trans('dashboard::dashboard.reset grid') }}</a>
        <a class="btn btn-default hidden" id="add-widget" data-toggle="modal" data-target="#myModal">{{ trans('dashboard::dashboard.add widget') }}</a>
    </div>
    <div class="clearfix"></div>
@stop

@push('css-stack')
    <style>
        .panel-title {
            color: white;
        }
    </style>
@endpush

@section('content')

    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="grid-stack">--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="clearfix"></div>--}}

    <div class="box-body">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$productCount}}</h3>

                        <p>Total Production</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bookmark"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$transferCount}}<sup style="font-size: 20px"></sup></h3>

                        <p>Total Transfer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$shipmentCount}}</h3>

                        <p>Total Shipment</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$thowingCount}}</h3>

                        <p>Total Thowing</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border" style="background-color: dodgerblue">
                        <h3 class="panel-title in-bold-white">New Production</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:white"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" style="color:white"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Lot No</th>
                                    <th>Fish Type</th>
                                    <th>Production Slab</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productionData as $data)
                                    <tr>
                                    <td>{{isset($data->product_date)?\Carbon\Carbon::parse($data->product_date)->format(PHP_DATE_FORMAT) : '' }}</td>
                                    <td>{{$data->lot_no}}</td>
                                    <td><span class="label label-success">{{$data->fishtype['type']}}</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{$data->product_slab }}</div>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border" style="background-color:dodgerblue">
                        <h3 class="panel-title in-bold-white">Recent Shipment</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:white"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" style="color:white"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Vehicle No</th>
                                    <th>Container No</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shipmentData as $data)
                                    <tr>
                                        <td>{{$data->invoice_no}}</td>
                                        <td>{{$data->vehicle_no}}</td>
                                        <td>{{$data->container_no}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border" style="background-color:dodgerblue">
                        <h3 class="panel-title in-bold-white">Recent Transfer</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:white"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" style="color:white"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Loading</th>
                                    <th>Quantity</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Vehicle</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0; ?>
                                @foreach($transferData as $data)
                                    <tr>
                                    <th>{{isset($data->loading_date)?\App\Libraries\Utils::parseDate($data->loading_date) : '' }}</th>
                                    {{--<th>--}}
                                        {{--@foreach($data->transfercarton as $cartons)--}}
                                            {{--<ul>--}}
                                                {{--<li>{{$cartons->quantity}}</li>--}}
                                            {{--</ul>--}}
                                        {{--@endforeach--}}
                                    {{--</th>--}}
                                        <th>
                                            @foreach($data->transfercarton as $cartons)
                                                <?php $total += $cartons->quantity ?>
                                            @endforeach
                                            {{$total}}
                                        </th>
                                    <td>{{$data->loadinglocation['location']}}</td>
                                    <td>{{$data->unloadinglocation['location']}}</td>
                                    <td>{{$data->vehicle_no}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border" style="background-color:dodgerblue">
                        <h3 class="panel-title in-bold-white">Recent Thowing</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:white"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" style="color:white"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Thowing Date</th>
                                    <th>Throwing Input</th>
                                    <th>Remark</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($thowingData as $data)
                                    <tr>
                                    <td>{{isset($data->carton_date)?\Carbon\Carbon::parse($data->carton_date)->format(PHP_DATE_FORMAT) : '' }}</td>
                                    <td>{{$data->throwing_input}}</td>
                                    <td>{{$data->comment}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
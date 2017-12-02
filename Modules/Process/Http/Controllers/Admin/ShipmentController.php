<?php

namespace Modules\Process\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Shipment;
use Modules\Process\Entities\ShipmentCarton;
use Modules\Process\Entities\TransferCarton;
use Modules\Process\Http\Requests\CreateShipmentRequest;
use Modules\Process\Http\Requests\UpdateShipmentRequest;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\ShipmentRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\UserRepository;

class ShipmentController extends AdminBaseController
{
    /**
     * @var ShipmentRepository
     */
    private $shipment;

    public function __construct(ShipmentRepository $shipment)
    {
        parent::__construct();

        $this->shipment = $shipment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $shipments = $this->shipment->all();

        return view('process::admin.shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location,'-',sublocation) AS name"),'id')
            ->pluck('name','id');

        $grade = app(GradeRepository::class)->allWithBuilder()
            ->orderBy('grade')
            ->pluck('grade','id');

        $varity = app(FishTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $users = app(UserRepository::class)->all();

        return view('process::admin.shipments.create',compact('locations','users','grade','varity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateShipmentRequest $request
     * @return Response
     */
    public function store(CreateShipmentRequest $request)
    {
        
        $data = [
            'container_no' => $request->container_no,
            'vehicle_no' => $request->vehicle_no,
            'location_id' => $request->location_id,
            'supervisor_id' => $request->supervisor_id,
            'eqc' => $request->eqc,
            'temperature' => $request->temperature,
            'start_time' =>Carbon::parse($request->loading_start_time),
            'end_time' =>Carbon::parse($request->loading_end_time) ,
            'seal_no' => $request->seal_no,
            'invoice_no' => $request->invoice_no
        ];
        $shipment = $this->shipment->create($data);

        $quantity = $request->carton['quantity'];

        $shippedCartons = [];

        $cartonLocationRepo = app(CartonLocationRepository::class);

        foreach ($request->carton['cartonId'] as $key => $value) {

            $data = [
                'carton_id' => $value,
                'shipment_id' => $shipment->id,
                'quantity' => $quantity[$key],
            ];
            array_push($shippedCartons, $data);

            $fromCartonLocation = $cartonLocationRepo->findByAttributes([
                'location_id' => $shipment->location_id,
                'carton_id' => $value
            ]);

            $fromCartonLocation->available_quantity = $fromCartonLocation->available_quantity -  $quantity[$key];
            $fromCartonLocation->shipped = $quantity[$key];
            $fromCartonLocation->save();
      }

        //Insert cartons in transfer cartons
        ShipmentCarton::insert($shippedCartons);
        
        
//        $this->shipment->create($request->all());

        return redirect()->route('admin.process.shipment.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::shipments.title.shipments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shipment $shipment
     * @return Response
     */
    public function edit(Shipment $shipment)
    {
        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location,'-',sublocation) AS name"),'id')
            ->pluck('name','id');

        $grade = app(GradeRepository::class)->allWithBuilder()
            ->orderBy('grade')
            ->pluck('grade','id');

        $varity = app(FishTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $shipment = $this->shipment->allWithBuilder()
            ->with(['shipmentcarton','shipmentcarton.carton'])
            ->find($shipment->id);
        
        $users = app(UserRepository::class)->all();

        return view('process::admin.shipments.edit', compact('shipment','users','locations','grade','varity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Shipment $shipment
     * @param  UpdateShipmentRequest $request
     * @return Response
     */
    public function update(Shipment $shipment, UpdateShipmentRequest $request)
    {
        $this->shipment->update($shipment, $request->all());

        return redirect()->route('admin.process.shipment.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::shipments.title.shipments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Shipment $shipment
     * @return Response
     */
    public function destroy(Shipment $shipment)
    {
        $this->shipment->destroy($shipment);

        return redirect()->route('admin.process.shipment.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::shipments.title.shipments')]));
    }
}

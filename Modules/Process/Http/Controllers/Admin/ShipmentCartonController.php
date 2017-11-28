<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\ShipmentCarton;
use Modules\Process\Http\Requests\CreateShipmentCartonRequest;
use Modules\Process\Http\Requests\UpdateShipmentCartonRequest;
use Modules\Process\Repositories\ShipmentCartonRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ShipmentCartonController extends AdminBaseController
{
    /**
     * @var ShipmentCartonRepository
     */
    private $shipmentcarton;

    public function __construct(ShipmentCartonRepository $shipmentcarton)
    {
        parent::__construct();

        $this->shipmentcarton = $shipmentcarton;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$shipmentcartons = $this->shipmentcarton->all();

        return view('process::admin.shipmentcartons.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.shipmentcartons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateShipmentCartonRequest $request
     * @return Response
     */
    public function store(CreateShipmentCartonRequest $request)
    {
        $this->shipmentcarton->create($request->all());

        return redirect()->route('admin.process.shipmentcarton.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::shipmentcartons.title.shipmentcartons')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ShipmentCarton $shipmentcarton
     * @return Response
     */
    public function edit(ShipmentCarton $shipmentcarton)
    {
        return view('process::admin.shipmentcartons.edit', compact('shipmentcarton'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ShipmentCarton $shipmentcarton
     * @param  UpdateShipmentCartonRequest $request
     * @return Response
     */
    public function update(ShipmentCarton $shipmentcarton, UpdateShipmentCartonRequest $request)
    {
        $this->shipmentcarton->update($shipmentcarton, $request->all());

        return redirect()->route('admin.process.shipmentcarton.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::shipmentcartons.title.shipmentcartons')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ShipmentCarton $shipmentcarton
     * @return Response
     */
    public function destroy(ShipmentCarton $shipmentcarton)
    {
        $this->shipmentcarton->destroy($shipmentcarton);

        return redirect()->route('admin.process.shipmentcarton.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::shipmentcartons.title.shipmentcartons')]));
    }
}

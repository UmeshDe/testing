<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\ShipmentFile;
use Modules\Process\Http\Requests\CreateShipmentFileRequest;
use Modules\Process\Http\Requests\UpdateShipmentFileRequest;
use Modules\Process\Repositories\ShipmentFileRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ShipmentFileController extends AdminBaseController
{
    /**
     * @var ShipmentFileRepository
     */
    private $shipmentfile;

    public function __construct(ShipmentFileRepository $shipmentfile)
    {
        parent::__construct();

        $this->shipmentfile = $shipmentfile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$shipmentfiles = $this->shipmentfile->all();

        return view('process::admin.shipmentfiles.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.shipmentfiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateShipmentFileRequest $request
     * @return Response
     */
    public function store(CreateShipmentFileRequest $request)
    {
        $this->shipmentfile->create($request->all());

        return redirect()->route('admin.process.shipmentfile.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::shipmentfiles.title.shipmentfiles')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ShipmentFile $shipmentfile
     * @return Response
     */
    public function edit(ShipmentFile $shipmentfile)
    {
        return view('process::admin.shipmentfiles.edit', compact('shipmentfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ShipmentFile $shipmentfile
     * @param  UpdateShipmentFileRequest $request
     * @return Response
     */
    public function update(ShipmentFile $shipmentfile, UpdateShipmentFileRequest $request)
    {
        $this->shipmentfile->update($shipmentfile, $request->all());

        return redirect()->route('admin.process.shipmentfile.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::shipmentfiles.title.shipmentfiles')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ShipmentFile $shipmentfile
     * @return Response
     */
    public function destroy(ShipmentFile $shipmentfile)
    {
        $this->shipmentfile->destroy($shipmentfile);

        return redirect()->route('admin.process.shipmentfile.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::shipmentfiles.title.shipmentfiles')]));
    }
}

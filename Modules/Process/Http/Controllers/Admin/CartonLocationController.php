<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\CartonLocation;
use Modules\Process\Http\Requests\CreateCartonLocationRequest;
use Modules\Process\Http\Requests\UpdateCartonLocationRequest;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CartonLocationController extends AdminBaseController
{
    /**
     * @var CartonLocationRepository
     */
    private $cartonlocation;

    public function __construct(CartonLocationRepository $cartonlocation)
    {
        parent::__construct();

        $this->cartonlocation = $cartonlocation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$cartonlocations = $this->cartonlocation->all();

        return view('process::admin.cartonlocations.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.cartonlocations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCartonLocationRequest $request
     * @return Response
     */
    public function store(CreateCartonLocationRequest $request)
    {
        $this->cartonlocation->create($request->all());

        return redirect()->route('admin.process.cartonlocation.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::cartonlocations.title.cartonlocations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CartonLocation $cartonlocation
     * @return Response
     */
    public function edit(CartonLocation $cartonlocation)
    {
        return view('process::admin.cartonlocations.edit', compact('cartonlocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CartonLocation $cartonlocation
     * @param  UpdateCartonLocationRequest $request
     * @return Response
     */
    public function update(CartonLocation $cartonlocation, UpdateCartonLocationRequest $request)
    {
        $this->cartonlocation->update($cartonlocation, $request->all());

        return redirect()->route('admin.process.cartonlocation.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::cartonlocations.title.cartonlocations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CartonLocation $cartonlocation
     * @return Response
     */
    public function destroy(CartonLocation $cartonlocation)
    {
        $this->cartonlocation->destroy($cartonlocation);

        return redirect()->route('admin.process.cartonlocation.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::cartonlocations.title.cartonlocations')]));
    }
}

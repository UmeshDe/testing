<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\Carton;
use Modules\Process\Http\Requests\CreateCartonRequest;
use Modules\Process\Http\Requests\UpdateCartonRequest;
use Modules\Process\Repositories\CartonRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CartonController extends AdminBaseController
{
    /**
     * @var CartonRepository
     */
    private $carton;

    public function __construct(CartonRepository $carton)
    {
        parent::__construct();

        $this->carton = $carton;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$cartons = $this->carton->all();

        return view('process::admin.cartons.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.cartons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCartonRequest $request
     * @return Response
     */
    public function store(CreateCartonRequest $request)
    {
        $this->carton->create($request->all());

        return redirect()->route('admin.process.carton.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::cartons.title.cartons')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Carton $carton
     * @return Response
     */
    public function edit(Carton $carton)
    {
        return view('process::admin.cartons.edit', compact('carton'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Carton $carton
     * @param  UpdateCartonRequest $request
     * @return Response
     */
    public function update(Carton $carton, UpdateCartonRequest $request)
    {
        $this->carton->update($carton, $request->all());

        return redirect()->route('admin.process.carton.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::cartons.title.cartons')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Carton $carton
     * @return Response
     */
    public function destroy(Carton $carton)
    {
        $this->carton->destroy($carton);

        return redirect()->route('admin.process.carton.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::cartons.title.cartons')]));
    }
}

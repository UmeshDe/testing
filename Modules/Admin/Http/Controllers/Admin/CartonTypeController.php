<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\CartonType;
use Modules\Admin\Http\Requests\CreateCartonTypeRequest;
use Modules\Admin\Http\Requests\UpdateCartonTypeRequest;
use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CartonTypeController extends AdminBaseController
{
    /**
     * @var CartonTypeRepository
     */
    private $cartontype;

    public function __construct(CartonTypeRepository $cartontype)
    {
        parent::__construct();

        $this->cartontype = $cartontype;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$cartontypes = $this->cartontype->all();

        return view('admin::admin.cartontypes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.cartontypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCartonTypeRequest $request
     * @return Response
     */
    public function store(CreateCartonTypeRequest $request)
    {
        $this->cartontype->create($request->all());

        return redirect()->route('admin.admin.cartontype.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::cartontypes.title.cartontypes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CartonType $cartontype
     * @return Response
     */
    public function edit(CartonType $cartontype)
    {
        return view('admin::admin.cartontypes.edit', compact('cartontype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CartonType $cartontype
     * @param  UpdateCartonTypeRequest $request
     * @return Response
     */
    public function update(CartonType $cartontype, UpdateCartonTypeRequest $request)
    {
        $this->cartontype->update($cartontype, $request->all());

        return redirect()->route('admin.admin.cartontype.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::cartontypes.title.cartontypes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CartonType $cartontype
     * @return Response
     */
    public function destroy(CartonType $cartontype)
    {
        $this->cartontype->destroy($cartontype);

        return redirect()->route('admin.admin.cartontype.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::cartontypes.title.cartontypes')]));
    }
}

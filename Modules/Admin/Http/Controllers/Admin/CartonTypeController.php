<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\CartonType;
use Modules\Admin\Http\Requests\CreateCartonTypeRequest;
use Modules\Admin\Http\Requests\UpdateCartonTypeRequest;
use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class CartonTypeController extends AdminBaseController
{
    /**
     * @var CartonTypeRepository
     */
    private $cartontype;
    
    
    private $auth;

    public function __construct(CartonTypeRepository $cartontype,Authentication $auth)
    {
        parent::__construct();

        $this->cartontype = $cartontype;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cartontypes = $this->cartontype->all();

        return view('admin::admin.cartontypes.index', compact('cartontypes'));
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
        $data = [
            'type' => $request->type,
            'created_by' => $this->auth->user()->id,
        ] ;
        $this->cartontype->create($data);

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
        $cartontype = $this->cartontype->find($request->type_id);
        $data = [
            'type' => $request->type,
            'created_by' => $this->auth->user()->id,
        ] ;
        $this->cartontype->update($cartontype, $data);


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

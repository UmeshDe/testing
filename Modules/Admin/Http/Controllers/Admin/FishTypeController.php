<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\FishType;
use Modules\Admin\Http\Requests\CreateFishTypeRequest;
use Modules\Admin\Http\Requests\UpdateFishTypeRequest;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class FishTypeController extends AdminBaseController
{
    /**
     * @var FishTypeRepository
     */
    private $fishtype;

    /**
     * @var
     */
    private $auth;

    public function __construct(FishTypeRepository $fishtype,Authentication $auth)
    {
        parent::__construct();

        $this->fishtype = $fishtype;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fishtypes = $this->fishtype->all();

        return view('admin::admin.fishtypes.index', compact('fishtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.fishtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFishTypeRequest $request
     * @return Response
     */
    public function store(CreateFishTypeRequest $request)
    {
        $data = [
            'type' => $request->type,
            'created_by' => $this->auth->user()->id,
        ];
        $this->fishtype->create($data);

        return redirect()->route('admin.admin.fishtype.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::fishtypes.title.fishtypes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FishType $fishtype
     * @return Response
     */
    public function edit(FishType $fishtype)
    {
        return view('admin::admin.fishtypes.edit', compact('fishtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FishType $fishtype
     * @param  UpdateFishTypeRequest $request
     * @return Response
     */
    public function update(FishType $fishtype, UpdateFishTypeRequest $request)
    {
        $fishtype = $this->fishtype->find($request->fishtype_id);
        $data = [
            'type' => $request->type,
            'created_by' => $this->auth->user()->id,
        ];
        $this->fishtype->update($fishtype, $data);

        return redirect()->route('admin.admin.fishtype.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::fishtypes.title.fishtypes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FishType $fishtype
     * @return Response
     */
    public function destroy(FishType $fishtype)
    {
        $this->fishtype->destroy($fishtype);

        return redirect()->route('admin.admin.fishtype.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::fishtypes.title.fishtypes')]));
    }
}

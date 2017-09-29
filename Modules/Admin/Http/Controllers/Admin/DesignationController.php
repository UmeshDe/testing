<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Designation;
use Modules\Admin\Http\Requests\CreateDesignationRequest;
use Modules\Admin\Http\Requests\UpdateDesignationRequest;
use Modules\Admin\Repositories\DesignationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class DesignationController extends AdminBaseController
{
    /**
     * @var DesignationRepository
     */
    private $designation;

    public function __construct(DesignationRepository $designation)
    {
        parent::__construct();

        $this->designation = $designation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$designations = $this->designation->all();

        return view('admin::admin.designations.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.designations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDesignationRequest $request
     * @return Response
     */
    public function store(CreateDesignationRequest $request)
    {
        $this->designation->create($request->all());

        return redirect()->route('admin.admin.designation.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::designations.title.designations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Designation $designation
     * @return Response
     */
    public function edit(Designation $designation)
    {
        return view('admin::admin.designations.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Designation $designation
     * @param  UpdateDesignationRequest $request
     * @return Response
     */
    public function update(Designation $designation, UpdateDesignationRequest $request)
    {
        $this->designation->update($designation, $request->all());

        return redirect()->route('admin.admin.designation.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::designations.title.designations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Designation $designation
     * @return Response
     */
    public function destroy(Designation $designation)
    {
        $this->designation->destroy($designation);

        return redirect()->route('admin.admin.designation.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::designations.title.designations')]));
    }
}

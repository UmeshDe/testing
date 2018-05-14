<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Designation;
use Modules\Admin\Http\Requests\CreateDesignationRequest;
use Modules\Admin\Http\Requests\UpdateDesignationRequest;
use Modules\Admin\Repositories\DepartmentRepository;
use Modules\Admin\Repositories\DesignationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class DesignationController extends AdminBaseController
{
    /**
     * @var DesignationRepository
     */
    private $designation;

    /**
     * @var
     */
    private $auth;

    public function __construct(DesignationRepository $designation,Authentication $auth)
    {
        parent::__construct();

        $this->designation = $designation;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $designations = $this->designation->all();
        $department = app(DepartmentRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->pluck('name','id');


        $desig = app(DesignationRepository::class)->allWithBuilder()
            ->orderBy('designation')
            ->pluck('designation','id');

        return view('admin::admin.designations.index', compact('designations','department','desig'));
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
        $data = [
            'department_id' => $request->department_id,
            'designation' => $request->designation,
            'description' => $request->description,
            'parent_designation' => (isset($request->parent_designation) && $request->parent_designation != '' )?$request->parent_designation:null,
            'created_by' => $this->auth->user()->id,
        ];
        $this->designation->create($data);

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
        $designation = $this->designation->find($request->desig_id);
        $data = [
            'designation' => $request->designation,
            'description' => $request->description,
            'created_by' => $this->auth->user()->id,
        ];
        $this->designation->update($designation, $data);

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

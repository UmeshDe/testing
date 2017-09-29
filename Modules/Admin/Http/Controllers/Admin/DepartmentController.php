<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Department;
use Modules\Admin\Http\Requests\CreateDepartmentRequest;
use Modules\Admin\Http\Requests\UpdateDepartmentRequest;
use Modules\Admin\Repositories\DepartmentRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class DepartmentController extends AdminBaseController
{
    /**
     * @var DepartmentRepository
     */
    private $department;


    private $auth;

    public function __construct(DepartmentRepository $department,Authentication $auth)
    {
        parent::__construct();

        $this->department = $department;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $departments = $this->department->all();
        $userrepo = app('Modules\User\Repositories\UserRepository');
        $user = $userrepo->all(['id','first_name'],'first_name');

        return view('admin::admin.departments.index', compact('departments','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDepartmentRequest $request
     * @return Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $data = [
            'manager_user_id' => $request->manager_user_id,
            'name' => $request->name,
            'department_code' => $request->department_code,
            'project_seq_no' => $request->project_seq_no,
            'description' => $request->description,
//             $name = $request->input('is_automatic'),
            'created_by' => $this->auth->user()->id,
            'is_automatic' => $request->input('is_automatic'),

        ];
        $this->department->create($data);

        return redirect()->route('admin.admin.department.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::departments.title.departments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Department $department
     * @return Response
     */
    public function edit(Department $department)
    {
        return view('admin::admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Department $department
     * @param  UpdateDepartmentRequest $request
     * @return Response
     */
    public function update(Department $department, UpdateDepartmentRequest $request)
    {
        $department = $this->department->find($request->dept_id);
        $data = [
            'name' => $request->name,
            'department_code' => $request->department_code,
            'project_seq_no' => $request->project_seq_no,
            'description' => $request->description,
            'is_automatic' => $request->input('is_automatic'),
            'created_by' => $this->auth->user()->id
        ];
        $this->department->update($department, $data);


        return redirect()->route('admin.admin.department.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::departments.title.departments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department $department
     * @return Response
     */
    public function destroy(Department $department)
    {
        $this->department->destroy($department);

        return redirect()->route('admin.admin.department.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::departments.title.departments')]));
    }
}

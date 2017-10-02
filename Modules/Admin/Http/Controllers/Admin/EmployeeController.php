<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Employee;
use Modules\Admin\Http\Requests\CreateEmployeeRequest;
use Modules\Admin\Http\Requests\UpdateEmployeeRequest;
use Modules\Admin\Repositories\EmployeeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class EmployeeController extends AdminBaseController
{
    /**
     * @var EmployeeRepository
     */
    private $employee;


    /**
     * @var
     */
    private $auth;
    protected $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
    ];

    public function __construct(EmployeeRepository $employee,Authentication $auth)
    {
        parent::__construct();

        $this->employee = $employee;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employees = $this->employee->allWithBuilder()
            ->with(['designation', 'department', 'user', 'currentShift', 'type'])
            ->get();
    
        return view('admin::admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id = null)
    {
        $roles = app(getRepoName('Role', 'User'))->all();

        $departments = app(getRepoName('Department', 'Profile'))->getNameValue();
        $designations = app(getRepoName('Designation', 'Profile'))->getNameValue('designation');
        $shifts = app(getRepoName('Shift', 'Attendance'))->getNameValue();
        $types = app(getRepoName('EmployeeType', 'Profile'))->getNameValue();
        $qualifications = app(getRepoName('Qualification', 'Profile'))->getNameValue();
        $languages = config('asgard.profile.config.languages');
        $bloodgroups = config('asgard.profile.config.bloodgroups');
        $managers = $this->employee->getAllManagers(true);

        return view('admin::admin.employees.create', compact('departments', 'designations', 'shifts', 'types', 'managers', 'languages', 'bloodgroups', 'roles', 'qualifications', 'useraddresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEmployeeRequest $request
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $this->employee->create($request->all());

        return redirect()->route('admin.admin.employee.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::employees.title.employees')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        return view('admin::admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Employee $employee
     * @param  UpdateEmployeeRequest $request
     * @return Response
     */
    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $this->employee->update($employee, $request->all());

        return redirect()->route('admin.admin.employee.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::employees.title.employees')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        $this->employee->destroy($employee);

        return redirect()->route('admin.admin.employee.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::employees.title.employees')]));
    }
}

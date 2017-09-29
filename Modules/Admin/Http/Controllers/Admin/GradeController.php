<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Grade;
use Modules\Admin\Http\Requests\CreateGradeRequest;
use Modules\Admin\Http\Requests\UpdateGradeRequest;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class GradeController extends AdminBaseController
{
    /**
     * @var GradeRepository
     */
    private $grade;

    /**
     * @var
     */
    private $auth;

    public function __construct(GradeRepository $grade,Authentication $auth)
    {
        parent::__construct();

        $this->grade = $grade;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grades = $this->grade->all();

        return view('admin::admin.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.grades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGradeRequest $request
     * @return Response
     */
    public function store(CreateGradeRequest $request)
    {
        $data = [
            'grade' => $request->grade,
            'created_by' => $this->auth->user()->id,
        ];
        $this->grade->create($data);

        return redirect()->route('admin.admin.grade.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::grades.title.grades')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Grade $grade
     * @return Response
     */
    public function edit(Grade $grade)
    {
        return view('admin::admin.grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Grade $grade
     * @param  UpdateGradeRequest $request
     * @return Response
     */
    public function update(Grade $grade, UpdateGradeRequest $request)
    {
        $grade = $this->grade->find($request->grade_id);
        $data = [
            'grade' => $request->grade,
            'created_by' => $this->auth->user()->id,
        ];
        $this->grade->update($grade, $data);

        return redirect()->route('admin.admin.grade.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::grades.title.grades')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Grade $grade
     * @return Response
     */
    public function destroy(Grade $grade)
    {
        $this->grade->destroy($grade);

        return redirect()->route('admin.admin.grade.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::grades.title.grades')]));
    }
}

<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Grade;
use Modules\Admin\Http\Requests\CreateGradeRequest;
use Modules\Admin\Http\Requests\UpdateGradeRequest;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class GradeController extends AdminBaseController
{
    /**
     * @var GradeRepository
     */
    private $grade;

    public function __construct(GradeRepository $grade)
    {
        parent::__construct();

        $this->grade = $grade;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$grades = $this->grade->all();

        return view('admin::admin.grades.index', compact(''));
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
        $this->grade->create($request->all());

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
        $this->grade->update($grade, $request->all());

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

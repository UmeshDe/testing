<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\CodeMaster;
use Modules\Admin\Http\Requests\CreateCodeMasterRequest;
use Modules\Admin\Http\Requests\UpdateCodeMasterRequest;
use Modules\Admin\Repositories\CodeMasterRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CodeMasterController extends AdminBaseController
{
    /**
     * @var CodeMasterRepository
     */
    private $codemaster;

    public function __construct(CodeMasterRepository $codemaster)
    {
        parent::__construct();

        $this->codemaster = $codemaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$codemasters = $this->codemaster->all();

        return view('admin::admin.codemasters.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.codemasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCodeMasterRequest $request
     * @return Response
     */
    public function store(CreateCodeMasterRequest $request)
    {
        $this->codemaster->create($request->all());

        return redirect()->route('admin.admin.codemaster.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::codemasters.title.codemasters')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CodeMaster $codemaster
     * @return Response
     */
    public function edit(CodeMaster $codemaster)
    {
        return view('admin::admin.codemasters.edit', compact('codemaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CodeMaster $codemaster
     * @param  UpdateCodeMasterRequest $request
     * @return Response
     */
    public function update(CodeMaster $codemaster, UpdateCodeMasterRequest $request)
    {
        $this->codemaster->update($codemaster, $request->all());

        return redirect()->route('admin.admin.codemaster.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::codemasters.title.codemasters')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CodeMaster $codemaster
     * @return Response
     */
    public function destroy(CodeMaster $codemaster)
    {
        $this->codemaster->destroy($codemaster);

        return redirect()->route('admin.admin.codemaster.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::codemasters.title.codemasters')]));
    }
}

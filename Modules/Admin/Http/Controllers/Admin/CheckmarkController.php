<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Checkmark;
use Modules\Admin\Http\Requests\CreateCheckmarkRequest;
use Modules\Admin\Http\Requests\UpdateCheckmarkRequest;
use Modules\Admin\Repositories\CheckmarkRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CheckmarkController extends AdminBaseController
{
    /**
     * @var CheckmarkRepository
     */
    private $checkmark;

    public function __construct(CheckmarkRepository $checkmark)
    {
        parent::__construct();

        $this->checkmark = $checkmark;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $checkmarks = $this->checkmark->all();

        return view('admin::admin.checkmarks.index', compact('checkmarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.checkmarks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCheckmarkRequest $request
     * @return Response
     */
    public function store(CreateCheckmarkRequest $request)
    {
        $this->checkmark->create($request->all());

        return redirect()->route('admin.admin.checkmark.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::checkmarks.title.checkmarks')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Checkmark $checkmark
     * @return Response
     */
    public function edit(Checkmark $checkmark)
    {
        return view('admin::admin.checkmarks.edit', compact('checkmark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Checkmark $checkmark
     * @param  UpdateCheckmarkRequest $request
     * @return Response
     */
    public function update(Checkmark $checkmark, UpdateCheckmarkRequest $request)
    {
        $checkmark = $this->checkmark->find($request->checkmaster_id);
        $this->checkmark->update($checkmark, $request->all());

        return redirect()->route('admin.admin.checkmark.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::checkmarks.title.checkmarks')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Checkmark $checkmark
     * @return Response
     */
    public function destroy(Checkmark $checkmark)
    {
        $this->checkmark->destroy($checkmark);

        return redirect()->route('admin.admin.checkmark.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::checkmarks.title.checkmarks')]));
    }
}

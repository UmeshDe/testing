<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\ApprovalNumber;
use Modules\Admin\Http\Requests\CreateApprovalNumberRequest;
use Modules\Admin\Http\Requests\UpdateApprovalNumberRequest;
use Modules\Admin\Repositories\ApprovalNumberRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ApprovalNumberController extends AdminBaseController
{
    /**
     * @var ApprovalNumberRepository
     */
    private $approvalnumber;

    public function __construct(ApprovalNumberRepository $approvalnumber)
    {
        parent::__construct();

        $this->approvalnumber = $approvalnumber;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$approvalnumbers = $this->approvalnumber->all();

        return view('admin::admin.approvalnumbers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.approvalnumbers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateApprovalNumberRequest $request
     * @return Response
     */
    public function store(CreateApprovalNumberRequest $request)
    {
        $this->approvalnumber->create($request->all());

        return redirect()->route('admin.admin.approvalnumber.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::approvalnumbers.title.approvalnumbers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ApprovalNumber $approvalnumber
     * @return Response
     */
    public function edit(ApprovalNumber $approvalnumber)
    {
        return view('admin::admin.approvalnumbers.edit', compact('approvalnumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ApprovalNumber $approvalnumber
     * @param  UpdateApprovalNumberRequest $request
     * @return Response
     */
    public function update(ApprovalNumber $approvalnumber, UpdateApprovalNumberRequest $request)
    {
        $this->approvalnumber->update($approvalnumber, $request->all());

        return redirect()->route('admin.admin.approvalnumber.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::approvalnumbers.title.approvalnumbers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ApprovalNumber $approvalnumber
     * @return Response
     */
    public function destroy(ApprovalNumber $approvalnumber)
    {
        $this->approvalnumber->destroy($approvalnumber);

        return redirect()->route('admin.admin.approvalnumber.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::approvalnumbers.title.approvalnumbers')]));
    }
}

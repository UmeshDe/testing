<?php

namespace Modules\Reports\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Reports\Entities\ReportMaster;
use Modules\Reports\Http\Requests\CreateReportMasterRequest;
use Modules\Reports\Http\Requests\UpdateReportMasterRequest;
use Modules\Reports\Repositories\ReportMasterRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ReportMasterController extends AdminBaseController
{
    /**
     * @var ReportMasterRepository
     */
    private $reportmaster;

    public function __construct(ReportMasterRepository $reportmaster)
    {
        parent::__construct();

        $this->reportmaster = $reportmaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$reportmasters = $this->reportmaster->all();

        return view('reports::admin.reportmasters.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('reports::admin.reportmasters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReportMasterRequest $request
     * @return Response
     */
    public function store(CreateReportMasterRequest $request)
    {
        $this->reportmaster->create($request->all());

        return redirect()->route('admin.reports.reportmaster.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('reports::reportmasters.title.reportmasters')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ReportMaster $reportmaster
     * @return Response
     */
    public function edit(ReportMaster $reportmaster)
    {
        return view('reports::admin.reportmasters.edit', compact('reportmaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReportMaster $reportmaster
     * @param  UpdateReportMasterRequest $request
     * @return Response
     */
    public function update(ReportMaster $reportmaster, UpdateReportMasterRequest $request)
    {
        $this->reportmaster->update($reportmaster, $request->all());

        return redirect()->route('admin.reports.reportmaster.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('reports::reportmasters.title.reportmasters')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ReportMaster $reportmaster
     * @return Response
     */
    public function destroy(ReportMaster $reportmaster)
    {
        $this->reportmaster->destroy($reportmaster);

        return redirect()->route('admin.reports.reportmaster.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('reports::reportmasters.title.reportmasters')]));
    }
}

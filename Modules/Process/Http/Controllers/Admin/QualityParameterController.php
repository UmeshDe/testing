<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\QualityParameter;
use Modules\Process\Http\Requests\CreateQualityParameterRequest;
use Modules\Process\Http\Requests\UpdateQualityParameterRequest;
use Modules\Process\Repositories\QualityParameterRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class QualityParameterController extends AdminBaseController
{
    /**
     * @var QualityParameterRepository
     */
    private $qualityparameter;

    public function __construct(QualityParameterRepository $qualityparameter)
    {
        parent::__construct();

        $this->qualityparameter = $qualityparameter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$qualityparameters = $this->qualityparameter->all();

        return view('process::admin.qualityparameters.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.qualityparameters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQualityParameterRequest $request
     * @return Response
     */
    public function store(CreateQualityParameterRequest $request)
    {
        $this->qualityparameter->create($request->all());

        return redirect()->route('admin.process.qualityparameter.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::qualityparameters.title.qualityparameters')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  QualityParameter $qualityparameter
     * @return Response
     */
    public function edit(QualityParameter $qualityparameter)
    {
        return view('process::admin.qualityparameters.edit', compact('qualityparameter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QualityParameter $qualityparameter
     * @param  UpdateQualityParameterRequest $request
     * @return Response
     */
    public function update(QualityParameter $qualityparameter, UpdateQualityParameterRequest $request)
    {
        $this->qualityparameter->update($qualityparameter, $request->all());

        return redirect()->route('admin.process.qualityparameter.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::qualityparameters.title.qualityparameters')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  QualityParameter $qualityparameter
     * @return Response
     */
    public function destroy(QualityParameter $qualityparameter)
    {
        $this->qualityparameter->destroy($qualityparameter);

        return redirect()->route('admin.process.qualityparameter.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::qualityparameters.title.qualityparameters')]));
    }
}

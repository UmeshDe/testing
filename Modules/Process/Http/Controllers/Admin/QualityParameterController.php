<?php

namespace Modules\Process\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Admin\Repositories\KindRepository;
use Modules\Process\Entities\Carton;
use Modules\Process\Entities\QualityParameter;
use Modules\Process\Http\Requests\CreateQualityParameterRequest;
use Modules\Process\Http\Requests\UpdateQualityParameterRequest;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\QualityParameterRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\UserRepository;

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
        $qualityparameters = $this->qualityparameter->all();
        $cartons = app(CartonRepository::class)->allWithBuilder()->all();
        return view('process::admin.qualityparameters.index', compact('qualityparameters','cartons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        
        $qualityparameter = app(QualityParameterRepository::class)->findByAttributes(['carton_id' => $request->id]);

        $cartons = app(CartonRepository::class)->findByAttributes(['id' => $request->id]);

        $grades = app(GradeRepository::class)->allWithBuilder()
            ->orderBy('grade')
            ->pluck('grade','id');

        $kinds = app(KindRepository::class)->allWithBuilder()
            ->orderBy('kind')
            ->pluck('kind','id');

        $users = app(UserRepository::class)->all();

        return view('process::admin.qualityparameters.create',compact('kinds','grades','qualityparameter','cartons','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQualityParameterRequest $request
     * @return Response
     */
    public function store(CreateQualityParameterRequest $request)
    {

        //Create Qualitycheck
        $qualitycheck = $this->qualityparameter->createQualityparameter($request);

        //If all parameters are entered mark quality check done
        if(isset($qualitycheck->suwari_work_force) &&
            isset($qualitycheck->suwari_length) &&
            isset($qualitycheck->suwari_gel_strength) &&
            isset($qualitycheck->gel_strength) &&
            isset($qualitycheck->length) &&
            isset($qualitycheck->work_force)){

            $cartons = app(CartonRepository::class)->findByAttributes(['id' => $request->id]);
            $cartons->qualitycheckdone = true;
            $cartons->carton_date = Carbon::parse($request->carton_date);
            $cartons->save();
        }

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
        $users = app(UserRepository::class)->all();

        $grades = app(GradeRepository::class)->allWithBuilder()
            ->orderBy('grade')
            ->pluck('grade','id');

        $kinds = app(KindRepository::class)->allWithBuilder()
            ->orderBy('kind')
            ->pluck('kind','id');

        $cartons = app(CartonRepository::class)->findByAttributes(['id' => $qualityparameter->carton_id]);

        return view('process::admin.qualityparameters.edit', compact('qualityparameter','cartons','grades','kinds','users'));

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
        $qualitycheck = $this->qualityparameter->update($qualityparameter, $request->all());

        //If all parameters are entered mark quality check done
        if(isset($qualitycheck->suwari_work_force) &&
            isset($qualitycheck->suwari_length) &&
            isset($qualitycheck->suwari_gel_strength) &&
            isset($qualitycheck->gel_strength) &&
            isset($qualitycheck->length) &&
            isset($qualitycheck->work_force)){

            $cartons = app(CartonRepository::class)->findByAttributes(['id' => $request->id]);
            $cartons->qualitycheckdone = true;
            $cartons->carton_date = Carbon::parse($request->carton_date);
            $cartons->save();
        }

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

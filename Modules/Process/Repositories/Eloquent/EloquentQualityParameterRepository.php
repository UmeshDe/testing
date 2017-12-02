<?php

namespace Modules\Process\Repositories\Eloquent;

use Modules\Process\Entities\Carton;
use Modules\Process\Http\Requests\CreateQualityParameterRequest;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\QualityParameterRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentQualityParameterRepository extends EloquentBaseRepository implements QualityParameterRepository
{

    public function createQualityparameter(CreateQualityParameterRequest $request)
    {
        return $this->create([
            'carton_id' => $request->id,
            'grade_id' => $request->grade_id,
            'kind_id' => $request->kind_id,
            'moisture' => $request->moisture,
            'kamaboko_hw' => $request->kamaboko_hw,
            'ashi' => $request->ashi,
            'contam' => $request->contam,
            'ph' => $request->ph,
            'work_force' => $request->work_force,
            'length' => $request->length,
            'gel_strength' => $request->gel_strength,
            'suwari_work_force' => $request->suwari_work_force,
            'suwari_length' => $request->suwari_length,
            'suwari_gel_strength' => $request->suwari_gel_strength,
            'supervisor_id' => $request->supervisor_id,
        ]);
    }
}

<?php

namespace Modules\Process\Repositories\Eloquent;

use Carbon\Carbon;
use Modules\Process\Entities\Carton;
use Modules\Process\Http\Requests\CreateQualityParameterRequest;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\QualityParameterRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentQualityParameterRepository extends EloquentBaseRepository implements QualityParameterRepository
{

    public function createQualityparameter(CreateQualityParameterRequest $request)
    {
        $user = auth()->user();

        return $this->create([
            'carton_id' => $request->id,
            'grade_id' => $request->grade_id,
            'kind_id' => $request->kind_id,
            'ic_id' => $request->ic_id,
            'moisture' => $request->moisture,
            'machine_moisture' => $request->machine_moisture,
            'machine_kamaboko_hw' => $request->machine_kamaboko_hw,
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
            'qcr_pageno' => $request->qcr_pageno,
            'inspection_date' => Carbon::parse($request->inspection_date),
            'qualitycheckdone_by' => $user->id,
            'w1' => $request->w1,
            'w2' => $request->w2,
            'w3' => $request->w3,
            'w4' => $request->w4,
            'w5' => $request->w5,
            'l1' => $request->l1,
            'l2' => $request->l2,
            'l3' => $request->l3,
            'l4' => $request->l4,
            'l5' => $request->l5,
            'sw1'=> $request->sw1,
            'sw2'=> $request->sw2,
            'sw3'=> $request->sw3,
            'sw4'=> $request->sw4,
            'sw5'=> $request->sw5,
            'sl1'=> $request->sl1,
            'sl2'=> $request->sl2 ,
            'sl3'=> $request->sl3,
            'sl4'=> $request->sl4,
            'sl5'=> $request->sl5,
        ]);
    }
}

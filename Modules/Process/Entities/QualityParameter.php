<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityParameter extends Model
{
    use SoftDeletes;

    protected $table = 'process__qualityparameters';
    public $translatedAttributes = [];
    protected $fillable = [
        'carton_id',
        'grade_id',
        'kind_id',
        'date',
        'grade',
        'moisture',
        'kamaboko_hw',
        'ashi',
        'contam',
        'ph',
        'work_force',
        'length',
        'gel_strength',
        'suwari_work_force',
        'suwari_length',
        'suwari_gel_strength',
        'approved_by',
        'created_by',
        'supervisor_id'
    ];
}

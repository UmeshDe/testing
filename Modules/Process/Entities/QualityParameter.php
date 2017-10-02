<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityParameter extends Model
{
    use SoftDeletes;

    protected $table = 'process__qualityparameters';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

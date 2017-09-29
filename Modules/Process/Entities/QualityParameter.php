<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class QualityParameter extends Model
{
    use Translatable;

    protected $table = 'process__qualityparameters';
    public $translatedAttributes = [];
    protected $fillable = [];
}

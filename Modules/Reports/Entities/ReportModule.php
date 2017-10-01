<?php

namespace Modules\Reports\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ReportModule extends Model
{

    use Translatable;

    protected $table = 'reports__reportmodules';
    public $translatedAttributes = [];
    protected $fillable = [];
}

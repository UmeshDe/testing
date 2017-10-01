<?php

namespace Modules\Reports\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ReportMaster extends Model
{

    protected $table = 'reports__reportmasters';
    public $translatedAttributes = [];
    protected $fillable = [];
}

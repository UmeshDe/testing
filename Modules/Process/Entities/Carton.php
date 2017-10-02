<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carton extends Model
{
    use SoftDeletes;

    protected $table = 'process__cartons';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

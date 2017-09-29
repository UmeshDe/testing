<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Carton extends Model
{
    use Translatable;

    protected $table = 'process__cartons';
    public $translatedAttributes = [];
    protected $fillable = [];
}

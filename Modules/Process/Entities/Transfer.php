<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use Translatable;

    protected $table = 'process__transfers';
    public $translatedAttributes = [];
    protected $fillable = [];
}

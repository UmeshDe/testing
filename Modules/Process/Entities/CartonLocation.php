<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CartonLocation extends Model
{
    use Translatable;

    protected $table = 'process__cartonlocations';
    public $translatedAttributes = [];
    protected $fillable = [];
}

<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    use Translatable;

    protected $table = 'process__productcodes';
    public $translatedAttributes = [];
    protected $fillable = [];
}

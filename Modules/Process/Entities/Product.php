<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Translatable;

    protected $table = 'process__products';
    public $translatedAttributes = [];
    protected $fillable = [];
}

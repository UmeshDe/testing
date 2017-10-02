<?php

namespace Modules\Process\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'process__products';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

<?php

namespace Modules\Process\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCode extends Model
{
    use SoftDeletes;

    protected $table = 'process__productcodes';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

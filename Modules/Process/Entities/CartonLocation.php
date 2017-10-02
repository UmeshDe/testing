<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartonLocation extends Model
{
    use SoftDeletes;

    protected $table = 'process__cartonlocations';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

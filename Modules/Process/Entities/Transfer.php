<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use SoftDeletes;

    protected $table = 'process__transfers';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkmark extends Model
{
    use SoftDeletes;

    protected $table = 'admin__checkmarks';
    public $translatedAttributes = [];
    protected $fillable = [
        'cm',
        'description'
    ];
}

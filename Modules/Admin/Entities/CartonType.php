<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartonType extends Model
{
    use SoftDeletes;

    protected $table = 'admin__cartontypes';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

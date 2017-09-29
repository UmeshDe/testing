<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CartonType extends Model
{
    use Translatable;

    protected $table = 'admin__cartontypes';
    public $translatedAttributes = [];
    protected $fillable = [];
}

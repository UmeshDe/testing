<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Translatable;

    protected $table = 'admin__employees';
    public $translatedAttributes = [];
    protected $fillable = [];
}

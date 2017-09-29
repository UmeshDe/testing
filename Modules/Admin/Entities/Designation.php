<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use Translatable;

    protected $table = 'admin__designations';
    public $translatedAttributes = [];
    protected $fillable = [];
}

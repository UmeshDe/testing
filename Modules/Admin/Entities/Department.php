<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Translatable;

    protected $table = 'admin__departments';
    public $translatedAttributes = [];
    protected $fillable = [];
}

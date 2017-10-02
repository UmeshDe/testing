<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kind extends Model
{
    use SoftDeletes;

    protected $table = 'admin__kinds';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use Translatable;

    protected $table = 'admin__kinds';
    public $translatedAttributes = [];
    protected $fillable = [];
}

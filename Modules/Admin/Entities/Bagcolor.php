<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bagcolor extends Model
{
    use SoftDeletes;

    protected $table = 'admin__bagcolors';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

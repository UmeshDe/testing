<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Bagcolor extends Model
{
    use Translatable;

    protected $table = 'admin__bagcolors';
    public $translatedAttributes = [];
    protected $fillable = [];
}

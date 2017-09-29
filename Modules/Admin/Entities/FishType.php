<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class FishType extends Model
{
    use Translatable;

    protected $table = 'admin__fishtypes';
    public $translatedAttributes = [];
    protected $fillable = [];
}

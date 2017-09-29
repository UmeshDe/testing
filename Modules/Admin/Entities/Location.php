<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Translatable;

    protected $table = 'admin__locations';
    public $translatedAttributes = [];
    protected $fillable = [];
}

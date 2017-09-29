<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use Translatable;

    protected $table = 'admin__grades';
    public $translatedAttributes = [];
    protected $fillable = [];
}

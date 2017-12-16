<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'admin__employees';
    public $translatedAttributes = [];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'user_id'
    ];
}

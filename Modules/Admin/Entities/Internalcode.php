<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Internalcode extends Model
{
    use SoftDeletes;

    protected $table = 'admin__internalcodes';
    public $translatedAttributes = [];
    protected $fillable = [
        'internal_code',
        'description'
    ];
}

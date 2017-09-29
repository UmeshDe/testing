<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CodeMaster extends Model
{
    use Translatable;

    protected $table = 'admin__codemasters';
    public $translatedAttributes = [];
    protected $fillable = [];
}

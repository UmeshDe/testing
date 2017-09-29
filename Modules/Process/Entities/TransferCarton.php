<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TransferCarton extends Model
{
    use Translatable;

    protected $table = 'process__transfercartons';
    public $translatedAttributes = [];
    protected $fillable = [];
}

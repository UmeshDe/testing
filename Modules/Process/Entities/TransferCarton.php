<?php

namespace Modules\Process\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferCarton extends Model
{
    use SoftDeletes;

    protected $table = 'process__transfercartons';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
}

<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ApprovalNumber extends Model
{
    use Translatable;

    protected $table = 'admin__approvalnumbers';
    public $translatedAttributes = [];
    protected $fillable = [];
}

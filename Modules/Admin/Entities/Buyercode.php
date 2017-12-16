<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyercode extends Model
{
    use SoftDeletes;

    protected $table = 'admin__buyercodes';
    public $translatedAttributes = [];
    protected $fillable = [
        'buyer_name',
        'buyer_code'
    ];
}

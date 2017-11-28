<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentCarton extends Model
{
    use SoftDeletes;

    protected $table = 'process__shipmentcartons';
    public $translatedAttributes = [];
    protected $fillable = [
        'shipment_id',
        'carton_id',
        'quantity',
    ];
}

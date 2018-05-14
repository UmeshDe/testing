<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentFile extends Model
{
    use SoftDeletes;

    protected $table = 'process__shipmentfiles';
    public $translatedAttributes = [];
    protected $fillable = [
        'shipment_id',
        'file_id'
    ];
}

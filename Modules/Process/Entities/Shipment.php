<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes;

    protected $table = 'process__shipments';
    public $translatedAttributes = [];
    protected $fillable = [
        'container_no',
        'vehicle_no',
        'location_id',
        'supervisor_id',
        'eqc',
        'temperature',
        'start_time',
        'end_time'
    ];
}

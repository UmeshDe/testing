<?php

namespace Modules\Process\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Grade;
use Modules\Admin\Entities\Location;
use Modules\User\Entities\Sentinel\User;

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
        'end_time',
        'seal_no',
        'invoice_no',
        'created_at',
        'updated_at',
        'shipment_via',
        'photo',
        'approval_no',
        'grade',
        'shipmentdone_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipmentcarton()
    {
        return $this->hasMany(ShipmentCarton::class, 'shipment_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carton()
    {
        return $this->belongsTo(Carton::class, 'carton_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id','id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipmentdone()
    {
        return $this->belongsTo(User::class,'shipmentdone_by','id');
    }
}

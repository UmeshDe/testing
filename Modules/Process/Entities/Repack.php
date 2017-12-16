<?php

namespace Modules\Process\Entities;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Location;
use Modules\User\Entities\Sentinel\User;

class Repack extends Model
{
    use SoftDeletes;

    protected $table = 'process__repacks';
    protected $fillable = [
        'carton_id',
        'location_id',
        'carton_date',
        'damaged_cartons',
        'comment',
        'repacked_cartons',
        'repackdone_by'
    ];

    /**
     * @param $value
     */
    public function setcartonDateAttribute($value)
    {
        $this->attributes['carton_date'] = Carbon::parse($value);
    }

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
    public function carton()
    {
        return $this->belongsTo(Carton::class,'carton_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repack()
    {
        return $this->belongsTo(User::class,'repackdone_by','id');
    }
}

<?php

namespace Modules\Process\Entities;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Location;
use Modules\User\Entities\Sentinel\User;

class Throwing extends Model
{
    use SoftDeletes;

    protected $table = 'process__throwings';
    public $translatedAttributes = [];
    protected $fillable = [
        'carton_id',
        'location_id',
        'carton_date',
        'throwing_input',
        'throwing_input_bags',
        'throwing_output_bags',
        'throwing_output',
        'comment',
        'thowing_start_time',
        'thowing_end_time',
        'thowing_supervisor',
        'user_id',
        'thowingdone_by',
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
    public function carton()
    {
        return $this->belongsTo(Carton::class,'carton_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thowingdone()
    {
        return $this->belongsTo(User::class,'thowingdone_by','id');
    }
}

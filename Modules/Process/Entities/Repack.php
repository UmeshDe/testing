<?php

namespace Modules\Process\Entities;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Bagcolor;
use Modules\Admin\Entities\CartonType;
use Modules\Admin\Entities\FishType;
use Modules\Admin\Entities\Grade;
use Modules\Admin\Entities\Location;
use Modules\User\Entities\Sentinel\User;

class Repack extends Model
{
    use SoftDeletes;

    protected $table = 'process__repacks';
    protected $fillable = [
        'carton_id',
        'location_id',
        'repack_date',
        'start_time',
        'end_time',
        'supervisor_id',
        'fishtype_id',
        'bagcolor_id',
        'cartontype_id',
        'lot_no',
        'remark',
        'repacked_cartons',
        'repackingdone_by',
        'grade_id'
    ];
    /**
     * @param $value
     */
    public function setrepackDateAttribute($value)
    {
        $this->attributes['repack_date'] = Carbon::parse($value);
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
        return $this->belongsTo(User::class,'repackingdone_by','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bagColor()
    {
        return $this->belongsTo(Bagcolor::class,'bagcolor_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fishtype()
    {
        return $this->belongsTo(FishType::class,'fishtype_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cartontype()
    {
        return $this->belongsTo(CartonType::class,'cartontype_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repackingdone()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id','id');
    }
}

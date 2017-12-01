<?php

namespace Modules\Process\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Grade;
use Modules\Admin\Entities\Kind;
use Modules\User\Entities\Sentinel\User;

class QualityParameter extends Model
{
    use SoftDeletes;

    protected $table = 'process__qualityparameters';
    public $translatedAttributes = [];
    protected $fillable = [
        'carton_id',
        'grade_id',
        'kind_id',
        'date',
        'grade',
        'moisture',
        'kamaboko_hw',
        'ashi',
        'contam',
        'ph',
        'work_force',
        'length',
        'gel_strength',
        'suwari_work_force',
        'suwari_length',
        'suwari_gel_strength',
        'approved_by',
        'created_by',
        'supervisor_id',
        'inspection_date'
    ];

    /**
     * @param $value
     */
    public function setinspectiondateAttribute($value)
    {
        $this->attributes['inspection_date'] = Carbon::parse($value);
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
    public function kinds()
    {
        return $this->belongsTo(Kind::class,'kind_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
    
    
    public function grades()
    {
        return $this->belongsTo(Grade::class,'grade_id','id');
    }
}

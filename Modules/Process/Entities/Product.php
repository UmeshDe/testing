<?php

namespace Modules\Process\Entities;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\ApprovalNumber;
use Modules\Admin\Entities\Bagcolor;
use Modules\Admin\Entities\CartonType;
use Modules\Admin\Entities\CodeMaster;
use Modules\Admin\Entities\FishType;
use Modules\Admin\Entities\Location;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'process__products';
    public $translatedAttributes = [];
    protected $guarded = ['id'];



    public function setcartonDateAttribute($value)
    {
        $this->attributes['carton_date'] = Carbon::parse($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function codes(){
        return $this->belongsToMany(CodeMaster::class,'process__productcodes','product_id','code_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variety(){
        return $this->belongsTo(FishType::class,'fish_type','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bagColor(){
        return $this->belongsTo(Bagcolor::class,'bag_color','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cartonType(){
        return $this->belongsTo(CartonType::class,'carton_type','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(){
        return $this->belongsTo(Location::class,'location_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fishtype(){
        return $this->belongsTo(FishType::class,'fish_type','id');
    }


    public function approval()
    {
        return $this->belongsTo(ApprovalNumber::class,'approval_no','id');
    }




}

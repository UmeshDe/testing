<?php

namespace Modules\Process\Entities;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\ApprovalNumber;
use Modules\Admin\Entities\Bagcolor;
use Modules\Admin\Entities\Buyercode;
use Modules\Admin\Entities\CartonType;
use Modules\Admin\Entities\Checkmark;
use Modules\Admin\Entities\CodeMaster;
use Modules\Admin\Entities\FishType;
use Modules\Admin\Entities\Location;
use Modules\Admin\Repositories\BuyercodeRepository;
use Modules\User\Entities\Sentinel\User;

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

    public function buyer()
    {
        return $this->belongsTo(Buyercode::class,'buyercode_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fm()
    {
        return $this->belongsTo(CodeMaster::class,'fm_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fr()
    {
        return $this->belongsTo(CodeMaster::class,'fr_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function d()
    {
        return $this->belongsTo(CodeMaster::class,'d_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function s()
    {
        return $this->belongsTo(CodeMaster::class,'s_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function a()
    {
        return $this->belongsTo(CodeMaster::class,'a_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function c()
    {
        return $this->belongsTo(CodeMaster::class,'c_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function p()
    {
        return $this->belongsTo(CodeMaster::class,'p_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function b()
    {
        return $this->belongsTo(CodeMaster::class,'b_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function m()
    {
        return $this->belongsTo(CodeMaster::class,'m_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function w()
    {
        return $this->belongsTo(CodeMaster::class,'w_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function q()
    {
        return $this->belongsTo(CodeMaster::class,'q_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sc()
    {
        return $this->belongsTo(CodeMaster::class,'sc_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lc()
    {
        return $this->belongsTo(CodeMaster::class,'lc_id','id');
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
    public function lastlot()
    {
        return $this->belongsTo(Product::class,'lot_no','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'packingdone_by','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cm()
    {
        return $this->belongsTo(Checkmark::class,'cm_id','id');
    }
}
    
<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Location;

class CartonLocation extends Model
{
    use SoftDeletes;

    protected $table = 'process__cartonlocations';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
    public function carton()
    {
        return $this->belongsTo(Carton::class,'carton_id','id');
    }
    
    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }
}

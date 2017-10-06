<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Location;

class Transfer extends Model
{
    use SoftDeletes;

    protected $table = 'process__transfers';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
    public function loadinglocation()
    {
        return $this->belongsTo(Location::class,'loading_location_id','id');
    }

    public function unloadinglocation()
    {
        return $this->belongsTo(Location::class,'unloading_location_id','id');
    }
}

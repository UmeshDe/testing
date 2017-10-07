<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Location;
use Modules\Process\Repositories\TransferCartonRepository;

class Transfer extends Model
{
    use SoftDeletes;

    protected $table = 'process__transfers';
    public $translatedAttributes = [];
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loadinglocation()
    {
        return $this->belongsTo(Location::class,'loading_location_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unloadinglocation()
    {
        return $this->belongsTo(Location::class,'unloading_location_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfercarton()
    {
        return $this->hasMany(TransferCarton::class,'transfer_id','id');
    }
}

<?php

namespace Modules\Process\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Bagcolor;

class Carton extends Model
{
    use SoftDeletes;

    protected $table = 'process__cartons';
    public $translatedAttributes = [];

    protected $fillable = [
        'product_id',
        'carton_date',
        'no_of_cartons',
        'rejected',
        'loose',
        'shipped',
        'local_sale',
        'waste',
        'missing',
        'carton_type',
        'bag_color',
        'location_id',
        'qualitycheckdone',
        'created_by',
        'updated_by',
        'deleted_by',
        'record_status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bagColor(){
        return $this->belongsTo(Bagcolor::class,'bag_color','id');
    }
}

<?php

namespace Modules\Process\Entities;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'comment'
    ];

    public function setcartonDateAttribute($value)
    {
        $this->attributes['carton_date'] = Carbon::parse($value);
    }

    public function carton()
    {
        return $this->belongsTo(Carton::class,'carton_id','id');
    }
}

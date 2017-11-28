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
        'throwing_output',
        'comment'
    ];

    public function setcartonDateAttribute($value)
    {
        $this->attributes['carton_date'] = Carbon::parse($value);
    }
}

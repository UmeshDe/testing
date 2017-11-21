<?php

namespace Modules\Process\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Process\Repositories\CartonRepository;

class TransferCarton extends Model
{
    use SoftDeletes;

    protected $table = 'process__transfercartons';
    public $translatedAttributes = [];
    protected $guarded = ['id'];
    
    public function carton()
    {
        return $this->belongsTo(Carton::class,'carton_id','id');
    }
    
    public function transfer()
    {
        return $this->belongsTo(Transfer::class,'transfer_id','id');
    }
}

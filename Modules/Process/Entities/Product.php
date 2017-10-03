<?php

namespace Modules\Process\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\CodeMaster;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'process__products';
    public $translatedAttributes = [];
    protected $guarded = ['id'];

    public function codes(){
        return $this->belongsToMany(CodeMaster::class,'process__productcodes','product_id','code_id','id');
    }
}

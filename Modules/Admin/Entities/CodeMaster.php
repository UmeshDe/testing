<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Process\Entities\Product;

class CodeMaster extends Model
{
    use SoftDeletes;

    protected $table = 'admin__codemasters';
    public $translatedAttributes = [];
    protected $guarded = ['id'];


    public function __toString() {
        return $this->code;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCodes()
    {
        return $this->hasMany(CodeMaster::class,'is_parent','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCode()
    {
        return $this->belongsTo(CodeMaster::class,'is_parent','id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'process__productcode','code_id','product_id');
    }
}

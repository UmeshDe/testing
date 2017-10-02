<?php

namespace Modules\Admin\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodeMaster extends Model
{
    use SoftDeletes;

    protected $table = 'admin__codemasters';
    public $translatedAttributes = [];
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCodes()
    {
        return $this->hasMany(CodeMaster::class,'is_parent','id');
    }
}

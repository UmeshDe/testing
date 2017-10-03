<?php

namespace Modules\Admin\Repositories\Eloquent;

use Illuminate\Http\Request;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentLocationRepository extends EloquentBaseRepository implements LocationRepository
{
    public function createLocation(Request $request){
        return $this->create($request->all());
    }
}

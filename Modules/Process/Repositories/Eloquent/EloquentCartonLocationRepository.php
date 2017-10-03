<?php

namespace Modules\Process\Repositories\Eloquent;

use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCartonLocationRepository extends EloquentBaseRepository implements CartonLocationRepository
{
    public function addCarton($locationId,$carton){

        return $this->create([
                    'carton_id' => $carton->id,
                    'location_id' => $locationId,
                    'available_quantity' => $carton->no_of_cartons,
                    'transit' => 0,
                    'loose' => $carton->loose,
                    'rejected' => $carton->rejected
                ]);
    }

}

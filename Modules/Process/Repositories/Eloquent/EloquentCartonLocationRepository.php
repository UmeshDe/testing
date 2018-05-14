<?php

namespace Modules\Process\Repositories\Eloquent;

use Modules\Process\Entities\CartonLocation;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCartonLocationRepository extends EloquentBaseRepository implements CartonLocationRepository
{
    public function addCarton($carton)
    {

        return $this->create([
            'carton_id' => $carton->id,
            //Commented By umesh we are getting carton location direactly from carton
//            'location_id' => $locationId,
            'location_id' => $carton->location_id,
            'available_quantity' => $carton->no_of_cartons,
            'transit' => 0,
            'loose' => $carton->loose,
            'rejected' => $carton->rejected
        ]);
    }

    public function updateCartonLocation($locationId, $carton)
    {
        $updateCartonLocation = $this->findByAttributes(['carton_id' => $carton->id]);

        $updateCartonLocation -> location_id = $locationId;

        $updateCartonLocation->save();

    }

}

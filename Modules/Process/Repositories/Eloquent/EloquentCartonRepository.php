<?php

namespace Modules\Process\Repositories\Eloquent;

use Modules\Process\Entities\Product;
use Modules\Process\Repositories\CartonRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCartonRepository extends EloquentBaseRepository implements CartonRepository
{
    public function createCarton(Product $product,$input){

        $input['product_id'] = $product->id;
        $input['shipped'] = 0;
        $input['local_sale'] = 0;
        $input['waste'] = 0;
        $input['missing'] = 0;
        $input['qualitycheckdone'] = false;

        return $this->create($input);

    }
}




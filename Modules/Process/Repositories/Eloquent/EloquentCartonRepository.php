<?php

namespace Modules\Process\Repositories\Eloquent;

use Modules\Process\Entities\Product;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\CartonRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Process\Repositories\ProductRepository;

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
    public function updateCarton(Carton $carton,$input){

        return $this->update($carton,$input);
    }
    public function getProduct($cartonlocations)
    {
        foreach ($cartonlocations as $cartonlots)
        {
            $cartons = app(CartonRepository::class)->findByAttributes(['id' => $cartonlots->carton_id]);

            //Product Lot
            $productlot = app(ProductRepository::class)->findByAttributes(['id' => $cartons->product_id]);

            //AvailableQuantity
            $cartonavailable = app(CartonLocationRepository::class)->findByAttributes(['carton_id' => $cartonlots->carton_id , 'id' => $cartonlots->id]);
            $lotnumbers = $productlot->lot_no;
            $quantity = $cartons->no_of_cartons;
            $productdate = $cartons->carton_date;
            $availableproduct = $cartonavailable->available_quantity;
            $cartonId = $cartons->id;
            $productformat [] = $cartonId.'||'.$productdate .'||'.$lotnumbers.'||'.$availableproduct;
        }
        return [$productformat];
    }
}




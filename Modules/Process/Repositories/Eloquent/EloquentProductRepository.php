<?php

namespace Modules\Process\Repositories\Eloquent;

use Illuminate\Http\Request;
use Modules\Process\Http\Requests\CreateProductRequest;
use Modules\Process\Repositories\ProductRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductRepository extends EloquentBaseRepository implements ProductRepository
{

    public function createProduct(CreateProductRequest $request){

        return $this->create([
            'product_date' => $request->product_date,
            'no_of_cartons' => $request->no_of_cartons,
            'approval_no' => $request->approval_no,
            'po_no' => $request->po_no,
            'lot_no' => $request->lot_no,
            'product_slab' => $request->product_slab,
            'fish_type'=>$request->fish_type
        ]);
    }
}

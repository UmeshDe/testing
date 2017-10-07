<?php

namespace Modules\Process\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Process\Entities\Carton;
use Modules\Process\Http\Requests\CreateProductRequest;
use Modules\Process\Http\Requests\UpdateProductRequest;
use Modules\Process\Repositories\ProductRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductRepository extends EloquentBaseRepository implements ProductRepository
{

    public function createProduct(CreateProductRequest $request){
    
        return $this->create([
            'product_date' =>Carbon::parse($request->product_date),
            'carton_date' => $request->carton_date,
            'no_of_cartons' => $request->no_of_cartons,
            'rejected' => $request->rejected,
            'loose' => $request->loose,
            'bag_color' => $request->bag_color,
            'carton_type' => $request->carton_type,
            'location_id' => $request->location_id,
            'approval_no' => $request->approval_no,
            'po_no' => $request->po_no,
            'lot_no' => $request->lot_no,
            'product_slab' => $request->product_slab,
            'fish_type'=>$request->fish_type,
            'remark' => $request->remark
        ]);
    }

    public function updateProduct(UpdateProductRequest $request,$product){
        return $this->update($product,
            [
                'product_date' => Carbon::parse($request->product_date),
                'carton_date' => $request->carton_date,
                'no_of_cartons' => $request->no_of_cartons,
                'rejected' => $request->rejected,
                'loose' => $request->loose,
                'carton_type' => $request->carton_type,
                'location_id' => $request->location_id,
                'approval_no' => $request->approval_no,
                'po_no' => $request->po_no,
                'lot_no' => $request->lot_no,
                'product_slab' => $request->product_slab,
                'fish_type'=>$request->fish_type,
                'remark' => $request->remark
            ]);
    }
}

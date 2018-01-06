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
        
        $user = auth()->user();
        
        return $this->create([
            'product_date' => Carbon::parse($request->product_date),
            'no_of_cartons' => $request->no_of_cartons,
            'rejected' => $request->rejected,
            'loose' => $request->loose,
            'approval_no' => $request->approval_no,
            'po_no' => $request->po_no,
            'bag_color' => $request->bag_color,
            'lot_no' => $request->lot_no,
            'product_slab' => $request->product_slab,
            'fish_type'=>$request->fish_type,
            'remark' => $request->remark,
            'buyercode_id' => $request->buyercode_id,
            'fm_id' => $request->fm_id,
            'fr_id' => $request->fr_id,
            'd_id' => $request->d_id,
            's_id' => $request->s_id,
            'a_id' => $request->a_id,
            'c_id' => $request->c_id,
            'p_id' => $request->p_id,
            'b_id' => $request->b_id,
            'm_id' => $request->m_id,
            'w_id' => $request->w_id,
            'q_id' => $request->q_id,
            'sc_id' => $request->sc_id,
            'lc_id' => $request->lc_id,
            'i_id' => $request->i_id,
            'k_id' => $request->k_id,
            'e_id' => $request->e_id,
            't_id' => $request->t_id,
            'sg_id' => $request->sg_id,
            'kg_id' => $request->kg_id,
            'g_id' => $request->g_id,
            'h_id' => $request->h_id,
            'rc_id' => $request->rc_id,
            'mk_id' => $request->mk_id,
            'user_id' => $user->id,
            'cm_id' => $request->cm_id
        ]);
    }

    public function updateProduct(UpdateProductRequest $request,$product){

        $user = auth()->user();

        return $this->update($product,
            [
                'product_date' => Carbon::parse($request->product_date),
                'carton_date' => Carbon::parse($request->carton_date),
                'no_of_cartons' => $request->no_of_cartons,
                'rejected' => $request->rejected,
                'loose' => $request->loose,
                'carton_type' => $request->carton_type,
                'location_id' => $request->location_id,
//                'approval_no' => $request->approval_no,
                'po_no' => $request->po_no,
                'lot_no' => $request->lot_no,
                'product_slab' => $request->product_slab,
//                'fish_type'=>$request->fish_type,
                'packing_remark' => $request->packing_remark,
                'human_error_slab' => $request->human_error_slab,
                'diff_in_kg' => $request->diff_in_kg,
                'packingdone' => true,
                'packingdone_by' => $user->id,
                'cm_id' => $request->cm_id
            ]);
    }
}

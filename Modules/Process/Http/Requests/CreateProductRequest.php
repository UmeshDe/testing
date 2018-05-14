<?php

namespace Modules\Process\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'lot_no' => 'required|unique_with:process__products,fish_type,carton_date',
//            'carton_date' => 'date_format:Y-m-d|unique_with:process__products,fish_type,lot_no',
            'fish_type' => 'required',
            'product_slab' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'lot_no.required' => 'Enter Lot Number',
            'lot_no.unique' => 'Lot Number  Already Exist',
            'fish_type.required' => 'Please Select Fish Type',
            'product_slab.required' => 'Please Enter Product Slab',
        ];
    }
}

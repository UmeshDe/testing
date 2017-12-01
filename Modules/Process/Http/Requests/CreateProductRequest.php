<?php

namespace Modules\Process\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'lot_no' => 'required|unique:process__products'
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
            'lot_no.unique' => 'Lot Number Already Exist'
        ];
    }
}

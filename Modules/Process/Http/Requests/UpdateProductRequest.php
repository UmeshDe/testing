<?php

namespace Modules\Process\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateProductRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'lot_no' => 'required',
            'location_id' => 'required',
            'no_of_cartons' => 'integer'
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
            'location_id.required' => 'Please Select Location'
        ];
    }
}

<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateBuyercodeRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'buyer_code' => 'required|unique:admin__buyercodes,buyer_code|max:255',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'buyer_code.required' => 'Please Enter Buyer Code',
            'buyer_code.unique' => 'Buyer Code Already Exist',
        ];
    }
}

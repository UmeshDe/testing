<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateInternalcodeRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'internal_code' => 'required|unique:admin__internalcodes,internal_code|max:255',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'internal_code.required' => 'Please Enter Internal Code',
            'internal_code.unique' => 'Internal Code Already Exist',
        ];
    }
}

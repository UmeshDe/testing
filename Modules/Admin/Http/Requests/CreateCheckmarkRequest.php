<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCheckmarkRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'cm' => 'required|unique:admin__checkmarks,cm|max:255',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'cm.required' => 'Please Enter CM',
            'cm.unique' => 'CM Already Exist',
        ];
    }
}

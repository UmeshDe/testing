<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateFishTypeRequest extends BaseFormRequest
{
    public function rules()
    {
         return [
            'type' => 'required|unique:admin__fishtypes,type,'.$this->type.',type|max:255',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'type.required' => 'Please Enter Fish Type',
            'type.unique' => 'Type Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

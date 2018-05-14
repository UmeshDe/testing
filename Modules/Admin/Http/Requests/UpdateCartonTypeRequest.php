<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCartonTypeRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'type' => 'required|unique:admin__cartontypes,type,'.$this->old_type.',type|max:255',
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
            'type.required' => 'Please Enter type',
            'type.unique' => 'Type Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

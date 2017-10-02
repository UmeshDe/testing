<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateKindRequest extends BaseFormRequest
{
    public function rules()
    {
         return [
            'kind' => 'required|unique:admin__kinds,kind|max:255',
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
        return [];
    }

    public function translationMessages()
    {
        return [
            'kind.required' => 'Please Enter Kind',
            'kind.unique' => 'Kind Already Exist',
        ];
    }
}

<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCodeMasterRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'code' => "required|unique:admin__codemasters,code|max:255",
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
            'code.required' => 'Please Enter Name',
            'code.unique' => 'Name Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

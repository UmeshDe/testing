<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCodeMasterRequest extends BaseFormRequest
{
    public function rules()
    {
         return [
            'name' => 'required|unique:admin__codemasters,name,'.$this->old_name.',name|max:255',
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
            'name.required' => 'Please Enter Name',
            'name.unique' => 'Name Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

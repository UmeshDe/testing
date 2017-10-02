<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateLocationRequest extends BaseFormRequest
{
    public function rules()
    {
         return [
            'name' => 'required|unique:admin__locations,name,'.$this->old_name.',name|max:255',
            'location' => 'required|max:255',
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
            'location.required' => 'Please Enter Location',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

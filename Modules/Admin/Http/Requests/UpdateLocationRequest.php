<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateLocationRequest extends BaseFormRequest
{
    public function rules()
    {
         return [
            'name' => 'required',
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
            'location.required' => 'Please Enter Location',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

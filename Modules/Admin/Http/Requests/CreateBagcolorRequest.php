<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateBagcolorRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'color' => 'required|unique:admin__bagcolors,color|max:255',
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
            'color.required' => 'Please Enter Color',
            'color.unique' => 'Color Alreaduy Exist',
        ];
    }

    public function translationMessages()
    {
         
    }
}

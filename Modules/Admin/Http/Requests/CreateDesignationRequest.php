<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateDesignationRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'department_id' => 'required',
            'designation' => 'required|unique:admin__designations,designation|max:255',
            'description' => 'max:255',
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
            'department_id.required' => 'Department is Required',
            'designation.required' => 'Designation is Required',
            'designation.unique' => 'Designation is Unique',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

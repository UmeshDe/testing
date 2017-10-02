<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateDepartmentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'department_code' => 'required|max:255',
            'project_seq_no' => 'required|max:255',
            'is_automatic' => 'required'
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
            'name.required' => 'Name is Required',
            'department_code.required' => 'Department is Required',
            'project_seq_no.required' => 'Sequence is Required',
            'is_automatic.required' => 'Automatic is Required'
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

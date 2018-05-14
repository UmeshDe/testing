<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateDepartmentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'manager_user_id' => 'required',
            'department_code' => 'required|max:255',
            'project_seq_no' => 'required|max:255',
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
            'name.required' => 'Name is Required',
            'manager_user_id.required' => 'Manager is Required',
            'department_code.required' => 'Department is Required',
            'project_seq_no.required' => 'Sequence is Required',
        ];
    }
}

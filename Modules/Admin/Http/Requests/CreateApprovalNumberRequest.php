<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateApprovalNumberRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'app_number' => 'required|unique:admin__approvalnumbers,app_number',
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
            'app_number.required' => 'Please Enter Approval Number',
            'app_number.unique' => 'Approval Number Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateEmployeeRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255'
        ];
    }
    
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please Enter Your First Namee',
            'last_name.required' => 'Please Enter Your Last Name',
            'email.required' => 'Please Enter Email'
        ];
    }

}

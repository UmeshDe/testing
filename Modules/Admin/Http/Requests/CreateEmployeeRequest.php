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
            'personal_contact_no' => 'required',
            'roles' => 'required',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
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
            'first_name.required' => 'Please Enter Your First Namee',
            'last_name.required' => 'Please Enter Your Last Name',
            'emp_id.required' => 'Please Enter Employee ID',
            'personal_contact_no.required' => 'Please Enter Contact Number',
            'roles.required' => 'Please select Role',
            'email.required' => 'Please Enter Email',
            'email.unique' => 'Email Already Exist',
            'password.required' => 'Please Enter Password',
            'password_confirmation.required' => 'Please Confirm Your Password',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

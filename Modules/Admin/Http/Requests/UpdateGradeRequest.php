<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateGradeRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'grade' => 'required|unique:admin__grades,grade,'.$this->old_grade.',grade|max:255',
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
            'grade.required' => 'Please Enter Grade',
            'grade.unique' => 'Grade Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateKindRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'kind' => 'required|unique:admin__kinds,kind,'.$this->old_kind.',kind',
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
            'kind.required' => 'Please Enter Kind',
            'kind.unique' => 'Kind Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

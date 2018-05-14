<?php

namespace Modules\Admin\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCodeMasterRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|unique_with:admin__codemasters,is_parent,',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'code.required' => 'Please Enter Code',
        ];
    }
}

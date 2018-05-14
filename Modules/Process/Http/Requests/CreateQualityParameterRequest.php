<?php

namespace Modules\Process\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateQualityParameterRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'supervisor_id' => 'required',
            'ph' => 'required',
            'machine_moisture' => 'required',
            'machine_kamaboko_hw' => 'required',
            'moisture' => 'required',
            'kamaboko_hw' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'supervisor_id.required' => 'Please Select Supervisor',
            'ph.required' => "Enter PH",
            'machine_moisture.required' => 'Enter Machine Moisture',
            'machine_kamaboko_hw.required' => 'Enter Machine Kamaboko',
            'moisture.required' => 'Enter Moisture',
            'kamaboko_hw.required' => 'Enter Kamaboko'
        ];
    }
}

<?php

namespace Modules\Process\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateTransferRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'container_no' => 'required',
            'vehicle_no' => 'required',
            'loading_location_id' => 'required',
            'unloading_location_id' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'container_no.required' => 'Enter Container Number',
            'vehicle_no.required' => 'Enter Vehicle',
            'loading_location_id.required' => 'Enter Loading Location',
            'unloading_location_id.required' => 'Enter Unloading Location',
        ];
    }
}

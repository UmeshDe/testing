<?php

namespace Modules\Process\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateShipmentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'container_no' => 'required',
            'vehicle_no' => 'required',
            'location_id' => 'required',
            'variety' => 'required',
            'carton_date' => 'required',
            'lot_no' => 'required',
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
            'vehicle_no.required' => 'Enter Vehicle Number',
            'location_id.required' => 'Enter Location',
            'variety.required' => 'Enter Variety',
            'carton_date.required' => 'Enter Carton Date',
            'lot_no.required' => 'Enter Lot Number'
        ];
    }
}

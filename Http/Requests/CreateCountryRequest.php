<?php

namespace Modules\Ilocations\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCountryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'currency' => 'required',
            'currency_symbol' => 'required',
            'currency_code' => 'required',
            'currency_sub_unit' => 'required',
            'region_code' => 'required',
            'sub_region_code' => 'required',
            'country_code' => 'required',
            'iso_2' => 'required',
            'iso_3' => 'required',
            'calling_code' => 'required',
            'status' => 'required',
        ];
    }

    public function translationRules()
    {
        return [
            'name' => 'required|min:2',
            'full_name' => 'required|min:2',
        ];
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
        return [];
    }
}

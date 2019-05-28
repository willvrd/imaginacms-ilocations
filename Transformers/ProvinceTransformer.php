<?php

namespace Modules\Ilocations\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProvinceTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [

            'id' => $this->when($this->id, $this->id),
            'name'=> $this->when($this->translate('en')->name,$this->translate('en')->name),
            'iso_2' => $this->when($this->iso_2, $this->iso_2),
            'calling_code' => $this->when($this->calling_code, $this->calling_code),
            'updated_at' => $this->when($this->updated_at, $this->updated_at),
            'country' => new CountryTransformer($this->whenLoaded('country')),
            'cities' => CityTransformer::collection($this->whenLoaded('cities')),

        ];

        return $data;
    }
}
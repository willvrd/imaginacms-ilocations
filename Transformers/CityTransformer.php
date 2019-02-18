<?php

namespace Modules\Ilocations\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CityTransformer extends Resource
{
    public function toArray($request)
    {


        $data = [

            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->translate('en')->name),
            'code' => $this->when($this->code, $this->code),
            'updated_at' => $this->when($this->updated_at, $this->updated_at),
            'provinces' => new ProvinceTransformer($this->whenLoaded('provinces')),
            'country' => new CountryTransformer($this->whenLoaded('country')),
        ];
        return $data;
    }
}
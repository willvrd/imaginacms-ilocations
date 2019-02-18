<?php

namespace Modules\Ilocations\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CountryTransformer extends Resource
{
    public function toArray($request)
    {


        $data = [
            'id'=>$this->when($this->id,$this->id),
            'name'=>$this->when($this->name,$this->translate('en')->name),
            'full_name'=>$this->when($this->full_name,$this->full_name),
            'iso_2'=>$this->when($this->iso_2,$this->iso_2),
            'status'=>$this->when($this->status,$this->status),
            'currency'=>$this->when($this->currency,$this->currency),
            'currency_symbol'=>$this->when($this->currency_symbol,$this->currency_symbol),
            'currency_code'=>$this->when($this->currency_code,$this->currency_code),
            'currency_sub_unit'=>$this->when($this->currency_sub_unit,$this->currency_sub_unit),
            'region_code'=>$this->when($this->region_code,$this->region_code),
            'country_code'=>$this->when($this->country_code,$this->country_code),
            'iso_3'=>$this->when($this->iso_3,$this->iso_3),
            'calling_code'=>$this->when($this->calling_code,$this->calling_code),
            'updated_at'=>$this->when($this->updated_at,$this->updated_at),
            'provinces'=> ProvinceTransformer::collection($this->whenLoaded('provinces')),
            'cities'=> CityTransformer::collection($this->whenLoaded('cities')),

        ];
            return $data;
    }
}
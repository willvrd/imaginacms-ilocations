<?php

namespace Modules\Ilocations\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CountryTransformer extends Resource
{
  public function toArray($request){
    $data = [
      "id" => $this->id,
      'name' => $this->name,
    ];
    if(isset($this->full_name))
      $data["full_name"]=$this->full_name;
    
    if(isset($this->iso_2))
      $data["iso_2"]=$this->iso_2;
    
    if(isset($this->status))
      $data["status"]=$this->status;
  
    if(isset($this->currency))
      $data["currency"]=$this->currency;
  
    if(isset($this->currency_symbol))
      $data["currency_symbol"]=$this->currency_symbol;
  
    if(isset($this->currency_code))
      $data["currency_code"]=$this->currency_code;
  
    if(isset($this->currency_sub_unit))
      $data["currency_sub_unit"]=$this->currency_sub_unit;
  
    if(isset($this->region_code))
      $data["region_code"]=$this->region_code;
  
    if(isset($this->sub_region_code))
      $data["sub_region_code"]=$this->sub_region_code;
  
    if(isset($this->country_code))
      $data["country_code"]=$this->country_code;
  
    if(isset($this->iso_3))
      $data["iso_3"]=$this->iso_3;
  
    if(isset($this->calling_code))
      $data["calling_code"]=$this->calling_code;
  
    if(isset($this->provinces))
      $data["provinces"]=$this->provinces;
  
    if(isset($this->cities))
      $data["cities"]=$this->cities;
  
    if(isset($this->updated_at))
      $data["updated_at"]=$this->updated_at;
    
    if(isset($this->created_at))
      $data["created_at"]=$this->created_at;
    
    
  
    return $data;
  }
}
<?php

namespace Modules\Ilocations\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProvinceTransformer extends Resource
{
  public function toArray($request){
    $data = [
      "id" => $this->id,
      'name' => $this->name,
    ];
  
    if(isset($this->iso_2))
      $data["iso_2"]=$this->iso_2;
  
    if(isset($this->country_id))
      $data["country_id"]=$this->country_id;
    
    if(isset($this->country))
      $data["country"]=$this->country;
  
    if(isset($this->updated_at))
      $data["updated_at"]=$this->updated_at;
    
    if(isset($this->created_at))
      $data["created_at"]=$this->created_at;
    
    return $data;
  }
}
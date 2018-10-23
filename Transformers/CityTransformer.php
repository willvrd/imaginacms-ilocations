<?php

namespace Modules\Ilocations\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CityTransformer extends Resource
{
  public function toArray($request){
    $data = [
      "id" => $this->id,
      'name' => $this->name,
    ];
  
    if(isset($this->code))
      $data["code"]=$this->code;
  
    if(isset($this->province_id))
      $data["province_id"]=$this->province_id;
    
    if(isset($this->country_id))
      $data["country_id"]=$this->country_id;
  
    if(isset($this->province))
      $data["province"]=$this->province;
    
    if(isset($this->country_id))
      $data["country_id"]=$this->country_id;
  
    if(isset($this->updated_at))
      $data["updated_at"]=$this->updated_at;
  
    if(isset($this->created_at))
      $data["created_at"]=$this->created_at;
    
    return $data;
  }
}
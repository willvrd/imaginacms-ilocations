<?php

namespace Modules\Ilocations\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  use Translatable;
  
  protected $table = 'ilocations__countries';
  public $translatedAttributes = [
    'name',
    'full_name'
  ];
  protected $fillable = [
    'currency',
    'currency_symbol',
    'currency_code',
    'currency_sub_unit',
    'region_code',
    'sub-region-code',
    'country_code',
    'iso_2',
    'iso_3',
    'calling_code',
    'status'
  ];
  
  public function provinces()
  {
    return $this->hasMany(Province::class);
  }
}

<?php

namespace Modules\Ilocations\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use Translatable;
  
  protected $table = 'ilocations__cities';
  public $translatedAttributes = [
    'name'
  ];
  protected $fillable = [
    'code'
  ];
}

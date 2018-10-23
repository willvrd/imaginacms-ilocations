<?php

namespace Modules\Ilocations\Entities;

use Illuminate\Database\Eloquent\Model;

class Geozones extends Model
{


    protected $table = 'ilocations__geozones';

    protected $fillable = [
      'name',
      'description'
    ];
  
  public function zones()
  {
    return $this->hasMany(GeozonesCountries::class);
  }
}

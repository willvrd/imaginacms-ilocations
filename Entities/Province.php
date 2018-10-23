<?php

namespace Modules\Ilocations\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use Translatable;

    protected $table = 'ilocations__provinces';
    public $translatedAttributes = [
    	'name'
    ];
    protected $fillable = [
    	'iso_2',
      'country_id',
    ];

    public function country()
    {
    	return $this->belongsTo(Country::class);
    }
  
  public function zones()
  {
    return $this->hasMany(GeozonesCountries::class);
  }
}

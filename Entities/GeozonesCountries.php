<?php

namespace Modules\Ilocations\Entities;

use Illuminate\Database\Eloquent\Model;

class GeozonesCountries extends Model
{
    protected $table = 'ilocations__geozones_countries_provinces';

    protected $fillable = [
        'geozone_id',
        'country_id',
        'province_id',
        'city_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function geoZone()
    {
        return $this->belongsTo(Geozones::class);
    }
}

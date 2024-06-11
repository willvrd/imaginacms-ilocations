<?php

namespace Modules\Ilocations\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use Translatable;

    protected $table = 'ilocations__provinces';

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'iso_2',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function children()
    {
        return $this->hasMany(City::class);
    }

    public function zones()
    {
        return $this->hasMany(GeozonesCountries::class);
    }

  public function getNameAttribute()
  {
      $currentTranslations = $this->getTranslation(locale());

      if (empty($currentTranslations) || empty($currentTranslations->toArray()['name'])) {
          $model = $this->getTranslation(\LaravelLocalization::getDefaultLocale());

          if (empty($model)) {
              return '';
          }

          return $model->toArray()['name'] ?? '';
      }

      return $currentTranslations->toArray()['name'];
  }

    public function geozones()
    {
        return $this->morphToMany(Geozones::class, 'geozonable');
    }

    public function __call($method, $parameters)
    {
        //i: Convert array to dot notation
        $config = implode('.', ['asgard.ilocations.config.relations.provinces', $method]);

        //i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);
            $bound = $function->bindTo($this);

            return $bound();
        }

        //i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}

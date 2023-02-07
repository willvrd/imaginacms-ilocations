<?php

namespace Modules\Ilocations\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Ilocations\Entities\City;
use Modules\Ilocations\Entities\Country;
use Modules\Ilocations\Entities\Province;

class CityTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    $countries = Country::get();
    $provinces = Province::get();
    $pathCO = base_path('/Modules/Ilocations/Assets/js/citiesCO.json');
    $pathUS = base_path('/Modules/Ilocations/Assets/js/citiesUS.json');
    $citiesCO = json_decode(file_get_contents($pathCO), true);
    $citiesUS = json_decode(file_get_contents($pathUS), true);
    $cities = array_merge($citiesCO, $citiesUS);

    foreach ($cities as $key => $city) {
      $currentCity = City::where("code", $city['code'])->first();
      if (!isset($currentCity->id)) {
        $countryCity = $countries->where("iso_2", $city['country_iso_2'])->first();
        $provinceCity = $provinces->where("iso_2", $city['province_iso_2'])->first();
        $city['country_id'] = $countryCity->id;
        $city['province_id'] = $provinceCity->id;
        unset($city['country_iso_2']);
        unset($city['province_iso_2']);
        City::create($city);
      }
    }
  }
}

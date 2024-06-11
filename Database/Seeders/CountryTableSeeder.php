<?php

namespace Modules\Ilocations\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Ilocations\Entities\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $path = base_path('/Modules/Ilocations/Assets/js/countries.json');
        $countries = json_decode(file_get_contents($path), true);

        foreach ($countries as $key => $country) {
            $currentCountry = Country::where('iso_3', $country['iso_3'])->first();

            if (! isset($currentCountry->id)) {
                Country::create($country);
            }
        }
    }
}

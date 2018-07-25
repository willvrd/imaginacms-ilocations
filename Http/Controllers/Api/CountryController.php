<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Modules\Core\Http\Controllers\BasePublicController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ilocations\Entities\Province;
use Modules\Ilocations\Entities\Country;
use Illuminate\Support\Facades\DB;

class CountryController extends BasePublicController
{

    public function allMinCountries()
    {
        try {
            $countries = Country::where('status',1)->get()->sortBy('name');
            $allMinCountries = [];
            foreach ($countries as $key => $country) {
                array_push($allMinCountries,[
                    'name' => $country->name,
                    'full_name' => $country->full_name,
                    'iso_2' => $country->iso_2,
                    'iso_3' => $country->iso_3,
                ]);
            }
            return response()->json($allMinCountries,200);
            
        } catch (Exception $e) {
            return response()->json($e->getMessage(),$e->status);
        }
    }

    public function allFullCountries()
    {
        try {
            $countries = Country::where('status',1)->get()->sortBy('name');
            return response()->json($countries,200);
            
        } catch (Exception $e) {
            return response()->json($e->getMessage() ,$e->status);
        }

    }

    public function allProvincesByCountryIso2($countryCode)
    {

        $country = Country::where('iso_2',$countryCode)->where('status',1)->first();
        if(count($country))
            $provinces = Province::where('country_id',$country->id)->get()->sortBy('name');
        else
            return response()->json('Country not Found',404);

        $allProvincesByCountryIso2=[];
        foreach ($provinces as $key => $province) {
            array_push($allProvincesByCountryIso2, [
                'name' => $province->name,
                'iso_2' => $province->iso_2,
            ]);
        }
         return response()->json($allProvincesByCountryIso2,200);
    }

    public function allProvincesByCountryIso3($countryCode)
    {

        $country = Country::where('iso_3',$countryCode)->where('status',1)->first();
        if(count($country))
            $provinces = Province::where('country_id',$country->id)->get()->sortBy('name');
        else
            return response()->json('Country not Found',404);
        $allProvincesByCountryIso3=[];
        foreach ($provinces as $key => $province) {
            array_push($allProvincesByCountryIso3, [
                'name' => $province->name,
                'iso_2' => $province->iso_2,
            ]);
        }
        return response()->json($allProvincesByCountryIso3,200);
        
    }
}

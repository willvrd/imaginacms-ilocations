<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

use Modules\Ilocations\Transformers\CountryTransformer;

use Modules\Ilocations\Repositories\CountryRepository;

class CountryApiController extends BaseApiController
{
  /**
   * @var Application
   */
  private $country;
  
  public function __construct(
    CountryRepository $country)
  {
    
    $this->country = $country;

  }
  
  public function index(Request $request)
{
  //try {
    //Get Parameters from URL.
    $p = $this->parametersUrl(false, false, ["status" => [1]], []);
    
    //Request to Repository
    $countries = $this->country->index($p->page, $p->take, $p->filter, $p->include, $p->fields);
    
    //Response
    $response = ["data" => CountryTransformer::collection($countries)];
    
    //If request pagination add meta-page
    $p->page ? $response["meta"] = ["page" => $this->pageTransformer($countries)] : false;
  /*} catch (\Exception $e) {
    //Message Error
    $status = 500;
    $response = [
      "errors" => $e->getMessage()
    ];
  }*/
  
  return response()->json($response, $status ?? 200);
}

}

<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ilocations\Transformers\CityTransformer;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Ilocations\Repositories\CityRepository;

class CityApiController extends BaseApiController
{
  /**
   * @var Application
   */
  private $city;
  
  public function __construct(
    CityRepository $city)
  {
    
    $this->city = $city;
    
  }
  
  public function index(Request $request)
  {
    //try {
    //Get Parameters from URL.
    $p = $this->parametersUrl(false, false, ["status" => [1]], []);
    
    //Request to Repository
    $cities = $this->city->index($p->page, $p->take, $p->filter, $p->include, $p->fields);
    
    //Response
    $response = ["data" => CityTransformer::collection($cities)];
    
    //If request pagination add meta-page
    $p->page ? $response["meta"] = ["page" => $this->pageTransformer($cities)] : false;
    /* } catch (\Exception $e) {
       //Message Error
       $status = 500;
       $response = [
         "errors" => $e->getMessage()
       ];
     }*/
    
    return response()->json($response, $status ?? 200);
  }
}

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

  
  /**
     * GET ITEMS
     * 
     * @return mixed
     */
    public function index(Request $request)
    {
      try {
        //Get Parameters from URL.
        $params = $this->getParamsRequest($request);
  
        //Request to Repository
        $dataEntity = $this->city->getItemsBy($params);
  
        //Response
        $response = ["data" => CityTransformer::collection($dataEntity)];
  
        //If request pagination add meta-page
        $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
      } catch (\Exception $e) {
        $status = $this->getStatusError($e->getCode());
        $response = ["errors" => $e->getMessage()];
      }
  
      //Return response
      return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }
    
    /**
       * GET A ITEM
       * 
       * @param $criteria
       * @return mixed
       */
      public function show($criteria,Request $request)
      {
        try {
          //Get Parameters from URL.
          $params = $this->getParamsRequest($request);
    
          //Request to Repository
          $dataEntity = $this->city->getItem($criteria, $params);
    
          //Break if no found item
          if(!$dataEntity) throw new Exception('Item not found',204);
          
          //Response
          $response = ["data" => new CityTransformer($dataEntity)];
    
          //If request pagination add meta-page
          $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
          $status = $this->getStatusError($e->getCode());
          $response = ["errors" => $e->getMessage()];
        }
    
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
      }
  
  
}

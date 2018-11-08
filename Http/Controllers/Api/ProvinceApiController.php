<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ilocations\Transformers\ProvinceTransformer;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Ilocations\Repositories\ProvinceRepository;

class ProvinceApiController extends BaseApiController
{
  /**
   * @var Application
   */
  private $province;
  
  public function __construct(
    ProvinceRepository $province)
{
  
  $this->province = $province;
  
}
  
  public function index(Request $request)
{
  //try {
    //Get Parameters from URL.
    $p = $this->parametersUrl(false, false, ["status" => [1]], []);

    //Request to Repository
    $provinces = $this->province->index($p->page, $p->take, $p->filter, $p->include, $p->fields);
    
    //Response
    $response = ["data" => ProvinceTransformer::collection($provinces)];
    
    //If request pagination add meta-page
    $p->page ? $response["meta"] = ["page" => $this->pageTransformer($provinces)] : false;
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

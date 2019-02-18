<?php

namespace Modules\Ilocations\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Ilocations\Repositories\ProvinceRepository;
use Modules\Ilocations\Transformers\ProvinceTransformer;

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
            $dataEntity = $this->province->getItemsBy($params);

            //Response
            $response = ["data" =>  ProvinceTransformer::collection($dataEntity)];

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

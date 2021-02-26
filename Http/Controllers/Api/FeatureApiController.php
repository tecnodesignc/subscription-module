<?php

namespace Modules\Subscription\Http\Controllers\Api;

// Requests & Response
use Modules\Subscription\Http\Requests\CreateFeatureRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Subscription\Transformers\FeatureTransformer;

// Repositories
use Modules\Subscription\Repositories\FeatureRepository;

class FeatureApiController extends BaseApiController
{
  private $feature;

  public function __construct(FeatureRepository $feature)
  {
    $this->feature = $feature;
  }

  /**
   * Get List Features
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);

      //Request to Repository
      $features = $this->feature->getItemsBy($params);

      //Response
      $response = ['data' => FeatureTransformer::collection($features)];

      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($features)] : false;
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
  public function show($criteria, Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);

      //Request to Repository
      $feature = $this->feature->getItem($criteria, $params);

      //Break if no found item
      if (!$feature) throw new \Exception('Item not found', 204);

      //Response
      $response = ["data" => new FeatureTransformer($feature)];

    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

  /**
   * CREATE A ITEM
   *
   * @param Request $request
   * @return mixed
   */
  public function create(Request $request)
  {
    \DB::beginTransaction();
    try {
      $data = $request->input('attributes') ?? [];//Get data

      //Validate Request
      $this->validateRequestApi(new CreateFeatureRequest($data));

      //Create item
      $feature = $this->feature->create($data);

      //Response
      $response = ["data" => new FeatureTransformer($feature)];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

  /**
   * UPDATE ITEM
   *
   * @param $criteria
   * @param Request $request
   * @return mixed
   */
  public function update($criteria, Request $request)
  {
    \DB::beginTransaction(); //DB Transaction
    try {
      //Get data
      $data = $request->input('attributes') ?? [];//Get data

      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);

      //Get feature
      $feature = $this->feature->getItem($criteria, $params);
      if(!$feature)
      throw new \Exception("Item not found", 404);

      //Request to Repository
      $this->feature->update($feature, $data);

      //Response
      $response = ["data" => 'Item Updated'];
      \DB::commit();//Commit to DataBase
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

  /**
   * DELETE A ITEM
   *
   * @param $criteria
   * @return mixed
   */
  public function delete($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      //Get params
      $params = $this->getParamsRequest($request);

      //Get feature
      $feature = $this->feature->getItem($criteria, $params);
      if(!$feature)
      throw new \Exception("Item not found", 404);

      //call Method delete
      $this->feature->destroy($feature);

      //Response
      $response = ["data" => "Item deleted"];
      \DB::commit();//Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

}

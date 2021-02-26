<?php

namespace Modules\Subscription\Http\Controllers\Api;

// Requests & Response
use Modules\Subscription\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Subscription\Transformers\ProductTransformer;

// Repositories
use Modules\Subscription\Repositories\ProductRepository;

class ProductApiController extends BaseApiController
{
  private $product;

  public function __construct(ProductRepository $product)
  {
    $this->product = $product;
  }

  /**
   * Get List Products
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);

      //Request to Repository
      $products = $this->product->getItemsBy($params);

      //Response
      $response = ['data' => ProductTransformer::collection($products)];

      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($products)] : false;
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
      $product = $this->product->getItem($criteria, $params);

      //Break if no found item
      if (!$product) throw new \Exception('Item not found', 204);

      //Response
      $response = ["data" => new ProductTransformer($product)];

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
      $this->validateRequestApi(new CreateProductRequest($data));

      //Create item
      $product = $this->product->create($data);

      //Response
      $response = ["data" => new ProductTransformer($product)];
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

      //Get product
      $product = $this->product->getItem($criteria, $params);
      if(!$product)
      throw new \Exception("Item not found", 404);

      //Request to Repository
      $this->product->update($product, $data);

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

      //Get product
      $product = $this->product->getItem($criteria, $params);
      if(!$product)
      throw new \Exception("Item not found", 404);

      //call Method delete
      $this->product->destroy($product);

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

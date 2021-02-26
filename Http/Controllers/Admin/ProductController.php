<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Subscription\Entities\Product;
use Modules\Subscription\Http\Requests\CreateProductRequest;
use Modules\Subscription\Http\Requests\UpdateProductRequest;
use Modules\Subscription\Repositories\ProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;
use Modules\User\Repositories\UserRepository;

class ProductController extends AdminBaseController
{
    /**
     * @var ProductRepository
     */
    private $product;

    public $users;

    public $file;


    public function __construct(ProductRepository $product, FileRepository $file, UserRepository $users)
    {
        parent::__construct();

        $this->product = $product;
        $this->file = $file;
        $this->users=$users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->product->paginate(9);

        return view('subscription::admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = $this->users->all();
        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireJs('icheck.js');
        return view('subscription::admin.products.create', compact( 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {

        try {
            $this->product->create($request->all());

            return redirect()->route('admin.subscription.product.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('subscription::products.title.products')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.product.index')
                ->withError(trans('core::core.messages.resource error', ['name' => trans('subscription::products.title.products')]));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $users = $this->users->all();
        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireJs('icheck.js');
        return view('subscription::admin.products.edit', compact('product',  'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product $product
     * @param  UpdateProductRequest $request
     * @return Response
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        try {
            $this->product->update($product, $request->all());

            return redirect()->route('admin.subscription.product.index')
                ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('subscription::products.title.products')]));

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.product.index')
                ->withSuccess(trans('core::core.messages.resource error', ['name' => trans('subscription::products.title.products')]));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        try {
            $this->product->destroy($product);

            return redirect()->route('admin.subscription.product.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('subscription::products.title.products')]));

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.product.index')
                ->withSuccess(trans('core::core.messages.resource error', ['name' => trans('subscription::products.title.products')]));

        }
    }
}

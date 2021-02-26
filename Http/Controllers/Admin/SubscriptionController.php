<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Http\Requests\CreateSubscriptionRequest;
use Modules\Subscription\Http\Requests\UpdateSubscriptionRequest;
use Modules\Subscription\Repositories\ProductRepository;
use Modules\Subscription\Repositories\SubscriptionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\UserRepository;

class SubscriptionController extends AdminBaseController
{
    /**
     * @var SubscriptionRepository
     */
    private $subscription;

    private $product;

    public $users;


    public function __construct(SubscriptionRepository $subscription, ProductRepository $product, UserRepository $users)
    {
        parent::__construct();

        $this->subscription = $subscription;
        $this->users=$users;
        $this->product=$product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $subscriptions = $this->subscription->paginate(50);

        return view('subscription::admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = $this->users->all();
        $products = $this->product->all();
        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireJs('icheck.js');
        return view('subscription::admin.subscriptions.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSubscriptionRequest $request
     * @return Response
     */
    public function store(CreateSubscriptionRequest $request)
    {
        try {
            $this->subscription->create($request->all());

            return redirect()->route('admin.subscription.subscription.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.product.index')
                ->withError(trans('core::core.messages.resource error', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subscription $subscription
     * @return Response
     */
    public function edit(Subscription $subscription)
    {
        $users = $this->users->all();
        $products = $this->product->all();
        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireJs('icheck.js');
        return view('subscription::admin.subscriptions.edit', compact('subscription', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Subscription $subscription
     * @param UpdateSubscriptionRequest $request
     * @return Response
     */
    public function update(Subscription $subscription, UpdateSubscriptionRequest $request)
    {
        try {
            $this->subscription->update($subscription, $request->all());

            return redirect()->route('admin.subscription.subscription.index')
                ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.subscription.index')
                ->withSuccess(trans('core::core.messages.resource error', ['name' => trans('subscription::subscriptions.title.subscriptions')]));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscription $subscription
     * @return Response
     */
    public function destroy(Subscription $subscription)
    {
        try {
            $this->subscription->destroy($subscription);

            return redirect()->route('admin.subscription.subscription.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.subscription.index')
                ->withSuccess(trans('core::core.messages.resource error', ['name' => trans('subscription::subscriptions.title.subscriptions')]));

        }
    }
}

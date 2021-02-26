<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Subscription\Entities\Plan;
use Modules\Subscription\Http\Requests\CreatePlanRequest;
use Modules\Subscription\Http\Requests\UpdatePlanRequest;
use Modules\Subscription\Repositories\PlanRepository;
use Modules\Subscription\Repositories\FeatureRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PlanController extends AdminBaseController
{
    /**
     * @var PlanRepository
     */
    private $plan;
    private $feature;
    private $plan_feature;

    public function __construct(PlanRepository $plan, FeatureRepository $feature)
    {
        parent::__construct();
        $this->plan = $plan;
        $this->feature = $feature;

    }

    /**
     * Display a listing of the resource.
     *
     * @param $product_id
     * @return Response
     */
    public function index($product_id)
    {
        $plans = $this->plan->whereProduct($product_id, 20);

        return view('subscription::admin.plans.index', compact('product_id', 'plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $product_id
     * @return Response
     */
    public function create($product_id)
    {
        $features = $this->feature->whereProduct($product_id, 50);
        $this->assetPipeline->requireJs('icheck.js');
        return view('subscription::admin.plans.create', compact('product_id', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $product_id
     * @param CreatePlanRequest $request
     * @return Response
     */
    public function store($product_id, Request $request)
    {

        try {
            if ($product_id == $request->product_id) {

                $this->plan->create($request->all());

                return redirect()->route('admin.subscription.plan.index',[$product_id])
                    ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('subscription::plans.title.plans')]));
            }
            return Redirect::back()->withErrors(trans('core::core.messages.resource error', ['name' => 'plan id does not match']))->withInput($request->all());
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()
                ->withError(trans('core::core.messages.resource error', ['name' => trans('subscription::plans.title.plans')]))->withInput($request->all());

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $product_id
     * @param Plan $plan
     * @return Response
     */
    public function edit($product_id, Plan $plan)
    {

        if ($product_id == $plan->product_id) {

            $features = $this->feature->whereProduct($product_id, 50);
            $this->assetPipeline->requireJs('ckeditor.js');
            return view('subscription::admin.plans.edit', compact( 'plan', 'features','product_id'));
        } else {
            //realizr una redireccion 404
            return abort(404);


        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $product_id
     * @param Plan $plan
     * @param UpdatePlanRequest $request
     * @return Response
     */
    public function update($product_id, Plan $plan, UpdatePlanRequest $request)
    {
        try {
            if ($product_id == $request->product_id) {
                $this->plan->update($plan, $request->all());
                return redirect()->route('admin.subscription.plan.index',[$product_id])
                    ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('subscription::plans.title.plans')]));
            }
            return Redirect::back()->withErrors(trans('core::core.messages.resource error', ['name' => 'plan id does not match']))->withInput($request->all());
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.plan.index',[$product_id])
                ->withSuccess(trans('core::core.messages.resource error', ['name' => trans('subscription::plans.title.plans')]));


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $product_id
     * @param Plan $plan
     * @return Response
     */
    public function destroy($product_id, Plan $plan)
    {
        try {
            $this->plan->destroy($plan);

            return redirect()->route('admin.subscription.plan.index',[$product_id])
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('subscription::plans.title.plans')]));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('admin.subscription.plan.index',[$product_id])
                ->withSuccess(trans('core::core.messages.resource error', ['name' => trans('subscription::plans.title.plans')]));


        }
    }
}

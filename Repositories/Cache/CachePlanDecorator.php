<?php

namespace Modules\Subscription\Repositories\Cache;

use Modules\Subscription\Repositories\PlanRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePlanDecorator extends BaseCacheDecorator implements PlanRepository
{
    public function __construct(PlanRepository $plan)
    {
        parent::__construct();
        $this->entityName = 'subscription.plans';
        $this->repository = $plan;
    }


    /**
     * where by product
     * @param $product_id
     * @param int $perPage
     * @return mixed
     * @internal param $paginate
     */
    public function whereProduct($product_id, $perPage = 15)
    {
        return $this->remember(function () use ($product_id, $perPage) {
            return $this->repository->whereProduct($product_id, $perPage);
        });
    }
}

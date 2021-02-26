<?php

namespace Modules\Subscription\Repositories\Cache;

use Modules\Subscription\Repositories\FeatureRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFeatureDecorator extends BaseCacheDecorator implements FeatureRepository
{
    public function __construct(FeatureRepository $feature)
    {
        parent::__construct();
        $this->entityName = 'subscription.features';
        $this->repository = $feature;
    }

    public function whereProduct($product_id, $perPage = 15)
    {
        return $this->remember(function () use ($product_id, $perPage) {
            return $this->repository->whereProduct($product_id, $perPage);
        });
    }
}

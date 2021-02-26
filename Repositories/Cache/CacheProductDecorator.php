<?php

namespace Modules\Subscription\Repositories\Cache;

use Modules\Subscription\Repositories\ProductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProductDecorator extends BaseCacheDecorator implements ProductRepository
{
    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->entityName = 'subscription.products';
        $this->repository = $product;
    }


    public function findBySystemName(string $systemName)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.findBySystemName", $this->cacheTime,
                function () {
                    return $this->repository->findBySystemName();
                }
            );
    }
}

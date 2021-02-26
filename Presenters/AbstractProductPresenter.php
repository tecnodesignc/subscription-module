<?php

namespace Modules\Subscription\Presenters;

use Modules\Subscription\Repositories\ProductRepository;

abstract class AbstractProductPresenter implements ProductPresenterInterface
{

    /**
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;

    /**
     * ProductPresenter constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

}

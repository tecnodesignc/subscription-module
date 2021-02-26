<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Product;
use Modules\Media\Contracts\StoringMedia;

class ProductWasUpdated implements StoringMedia
{

    /**
     * @var array
     */
    public array $data;

    /**
     * @var Product
     */
    private Product $product;

    /**
    private $product;
     /**
     * Create a new event instance.
     *
     * @param $product
     * @param array $data
     */
    public function __construct(Product $product, array $data)
    {
        $this->data = $data;
        $this->product=$product;
    }

    /**
     * Return the entity
     * @return Product
     */
    public function getEntity()
    {
        return $this->product;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}

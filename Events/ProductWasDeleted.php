<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Product;
use Modules\Media\Contracts\DeletingMedia;

class ProductWasDeleted implements  DeletingMedia
{


    private $product;
     /**
     * Create a new event instance.
     *
     * @param $product
     * @param array $data
     */
    public function __construct(Product $product)
    {
         $this->product=$product;
    }

    public function getEntityId()
    {
        return $this->product->id;
    }

    public function getClassName()
    {
        return get_class($this->product);
    }
}

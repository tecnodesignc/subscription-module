<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Product;
use Modules\Media\Contracts\StoringMedia;

class ProductWasCreated implements StoringMedia
{

    private $product;
    public  $data;

    /**
     * Create a new event instance.
     *
     * @param $product
     * @param array $data
     */
    public function __construct($product,array $data)
    {
        $this->data=$data;
        $this->product=$product;
    }

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

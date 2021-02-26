<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Feature;
use Modules\Media\Contracts\StoringMedia;

class FeatureWasCreated implements StoringMedia
{

    private $feature;
    public  $data;

    /**
     * Create a new event instance.
     *
     * @param $feature
     * @param array $data
     */
    public function __construct($feature,array $data)
    {
        $this->data=$data;
        $this->feature=$feature;
    }

    public function getEntity()
    {
        return $this->feature;
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

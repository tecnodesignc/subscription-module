<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Plan;
use Modules\Media\Contracts\StoringMedia;

class PlanWasCreated implements StoringMedia
{

    private $plan;
    public  $data;

    /**
     * Create a new event instance.
     *
     * @param $plan
     * @param array $data
     */
    public function __construct($plan,array $data)
    {
        $this->data=$data;
        $this->plan=$plan;
    }

    public function getEntity()
    {
        return $this->plan;
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

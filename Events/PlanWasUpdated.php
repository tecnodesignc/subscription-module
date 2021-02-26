<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Plan;
use Modules\Media\Contracts\StoringMedia;

class PlanWasUpdated implements StoringMedia
{


    private $plan;

    private array $data;

    /**
     * Create a new event instance.
     *
     * @param Plan $plan
     * @param array $data
     */
    public function __construct(Plan $plan, array $data)
    {
        $this->data = $data;
        $this->plan=$plan;
    }

    /**
     * Return the entity
     * @return Plan
     */
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

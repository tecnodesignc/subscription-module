<?php

namespace Modules\Subscription\Events;

use Modules\Subscription\Entities\Feature;
use Modules\Media\Contracts\DeletingMedia;

class FeatureWasDeleted implements  DeletingMedia
{


    private $feature;
     /**
     * Create a new event instance.
     *
     * @param $feature
     * @param array $data
     */
    public function __construct(Feature $feature)
    {
         $this->feature=$feature;
    }

    public function getEntityId()
    {
        return $this->feature->id;
    }

    public function getClassName()
    {
        return get_class($this->feature);
    }
}

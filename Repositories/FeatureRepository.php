<?php

namespace Modules\Subscription\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface FeatureRepository extends BaseRepository
{


    public function whereProduct($product_id,$perPage = 15);
}

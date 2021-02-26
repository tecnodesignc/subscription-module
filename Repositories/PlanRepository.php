<?php

namespace Modules\Subscription\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PlanRepository extends BaseRepository
{
    /**
     * where by product
     * @param $product_id
     * @param int $perPage
     * @return mixed
     * @internal param $paginate
     */
    public function whereProduct($product_id,$perPage = 15);
}

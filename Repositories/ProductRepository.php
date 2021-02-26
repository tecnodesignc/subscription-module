<?php

namespace Modules\Subscription\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ProductRepository extends BaseRepository
{
    /**
     * @param string $systemName
     * @return Object
     */
    public function findBySystemName(string $systemName);
}

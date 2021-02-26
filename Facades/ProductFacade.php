<?php

namespace Modules\Subscription\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Subscription\Presenters\ProductViewPresenter;


class ProductFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProductViewPresenter::class;
    }

}

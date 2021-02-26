<?php

namespace Modules\Subscription\Presenters;

interface ProductPresenterInterface
{
    /**
     * @param string $productName
     * @return string rendered slider
     */
    public function render(string $productName);
}

<?php

namespace Modules\Subscription\Presenters;

use Illuminate\Support\Facades\View;
use Modules\Subscription\Entities\Product;

class ProductViewPresenter extends AbstractProductPresenter implements ProductPresenterInterface
{

    /**
     * renders product.
     * @param string|Product $product
     * pass Product instance to render specific product
     * pass string to automatically retrieve product from repository
     * @param string $template blade template to render product
     * @param array $options
     * @return string rendered product HTML
     */
    public function render($product, $template = 'subscription::frontend.bootstrap.product', $options=[])
    {
        if (!$product instanceof Product) {
            $product = $this->getProductFromRepository($product);
            if ($product && $product->active == false) {    // inactive product must not render
                return '';
            }
        }
        if (!$product) {
            return '';
        }

        $view = View::make($template)
            ->with([
                'product' => $product,
                'options'=>$options
            ]);

        return $view->render();
    }


    /**
     * @param $systemName
     * @return Object
     */
    private function getProductFromRepository($systemName)
    {
        return $this->productRepository->findBySystemName($systemName);
    }
}

<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/subscription'], function (Router $router) {
    $router->group(['prefix' => '/products'], function (Router $router) {
        $router->bind('product', function ($id) {
            return app('Modules\Subscription\Repositories\ProductRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.subscription.product.index',
            'uses' => 'ProductController@index',
            'middleware' => 'can:subscription.products.index'
        ]);
        $router->get('/create', [
            'as' => 'admin.subscription.product.create',
            'uses' => 'ProductController@create',
            'middleware' => 'can:subscription.products.create'
        ]);
        $router->post('/', [
            'as' => 'admin.subscription.product.store',
            'uses' => 'ProductController@store',
            'middleware' => 'can:subscription.products.create'
        ]);
        $router->get('/{product}/edit', [
            'as' => 'admin.subscription.product.edit',
            'uses' => 'ProductController@edit',
            'middleware' => 'can:subscription.products.edit'
        ]);
        $router->put('/{product}', [
            'as' => 'admin.subscription.product.update',
            'uses' => 'ProductController@update',
            'middleware' => 'can:subscription.products.edit'
        ]);
        $router->delete('/{product}', [
            'as' => 'admin.subscription.product.destroy',
            'uses' => 'ProductController@destroy',
            'middleware' => 'can:subscription.products.destroy'
        ]);
        $router->group(['prefix' => '/{product_id}/plans'], function (Router $router) {
            $router->bind('plan', function ($id) {
                return app('Modules\Subscription\Repositories\PlanRepository')->find($id);
            });
            $router->get('/', [
                'as' => 'admin.subscription.plan.index',
                'uses' => 'PlanController@index',
                'middleware' => 'can:subscription.plans.index'
            ]);
            $router->get('/create', [
                'as' => 'admin.subscription.plan.create',
                'uses' => 'PlanController@create',
                'middleware' => 'can:subscription.plans.create'
            ]);
            $router->post('/', [
                'as' => 'admin.subscription.plan.store',
                'uses' => 'PlanController@store',
                'middleware' => 'can:subscription.plans.create'
            ]);
            $router->get('/{plan}/edit', [
                'as' => 'admin.subscription.plan.edit',
                'uses' => 'PlanController@edit',
                'middleware' => 'can:subscription.plans.edit'
            ]);
            $router->put('/{plan}', [
                'as' => 'admin.subscription.plan.update',
                'uses' => 'PlanController@update',
                'middleware' => 'can:subscription.plans.edit'
            ]);
            $router->delete('/{plan}', [
                'as' => 'admin.subscription.plan.destroy',
                'uses' => 'PlanController@destroy',
                'middleware' => 'can:subscription.plans.destroy'
            ]);
        });
        $router->group(['prefix' => '/{product_id}/features'], function (Router $router) {
            $router->bind('feature', function ($id) {
                return app('Modules\Subscription\Repositories\FeatureRepository')->find($id);
            });
            $router->get('/', [
                'as' => 'admin.subscription.feature.index',
                'uses' => 'FeatureController@index',
                'middleware' => 'can:subscription.features.index'
            ]);
            $router->get('/create', [
                'as' => 'admin.subscription.feature.create',
                'uses' => 'FeatureController@create',
                'middleware' => 'can:subscription.features.create'
            ]);
            $router->post('/', [
                'as' => 'admin.subscription.feature.store',
                'uses' => 'FeatureController@store',
                'middleware' => 'can:subscription.features.create'
            ]);
            $router->get('/{feature}/edit', [
                'as' => 'admin.subscription.feature.edit',
                'uses' => 'FeatureController@edit',
                'middleware' => 'can:subscription.features.edit'
            ]);
            $router->put('/{feature}', [
                'as' => 'admin.subscription.feature.update',
                'uses' => 'FeatureController@update',
                'middleware' => 'can:subscription.features.edit'
            ]);
            $router->delete('/{feature}', [
                'as' => 'admin.subscription.feature.destroy',
                'uses' => 'FeatureController@destroy',
                'middleware' => 'can:subscription.features.destroy'
            ]);
        });
    });
    $router->group(['prefix' => '/subscription'], function (Router $router) {
        $router->bind('subscription', function ($id) {
            return app('Modules\Subscription\Repositories\SubscriptionRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.subscription.subscription.index',
            'uses' => 'SubscriptionController@index',
            'middleware' => 'can:subscription.subscriptions.index'
        ]);
        $router->get('/create', [
            'as' => 'admin.subscription.subscription.create',
            'uses' => 'SubscriptionController@create',
            'middleware' => 'can:subscription.subscriptions.create'
        ]);
        $router->post('/', [
            'as' => 'admin.subscription.subscription.store',
            'uses' => 'SubscriptionController@store',
            'middleware' => 'can:subscription.subscriptions.create'
        ]);
        $router->get('/{subscription}/edit', [
            'as' => 'admin.subscription.subscription.edit',
            'uses' => 'SubscriptionController@edit',
            'middleware' => 'can:subscription.subscriptions.edit'
        ]);
        $router->put('/{subscription}', [
            'as' => 'admin.subscription.subscription.update',
            'uses' => 'SubscriptionController@update',
            'middleware' => 'can:subscription.subscriptions.edit'
        ]);
        $router->delete('/{subscription}', [
            'as' => 'admin.subscription.subscription.destroy',
            'uses' => 'SubscriptionController@destroy',
            'middleware' => 'can:subscription.subscriptions.destroy'
        ]);
    });
// append
});

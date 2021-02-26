<?php

namespace Modules\Subscription\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Illuminate\Support\Arr;
use Modules\Subscription\Events\Handlers\RegisterSubscriptionSidebar;

class SubscriptionServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterSubscriptionSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('products', Arr::dot(trans('subscription::products')));
            $event->load('plans', Arr::dot(trans('subscription::plans')));
            $event->load('features', Arr::dot(trans('subscription::features')));
            $event->load('subscriptions', Arr::dot(trans('subscription::subscriptions')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('subscription', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Subscription\Repositories\ProductRepository',
            function () {
                $repository = new \Modules\Subscription\Repositories\Eloquent\EloquentProductRepository(new \Modules\Subscription\Entities\Product());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Subscription\Repositories\Cache\CacheProductDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Subscription\Repositories\PlanRepository',
            function () {
                $repository = new \Modules\Subscription\Repositories\Eloquent\EloquentPlanRepository(new \Modules\Subscription\Entities\Plan());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Subscription\Repositories\Cache\CachePlanDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Subscription\Repositories\FeatureRepository',
            function () {
                $repository = new \Modules\Subscription\Repositories\Eloquent\EloquentFeatureRepository(new \Modules\Subscription\Entities\Feature());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Subscription\Repositories\Cache\CacheFeatureDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Subscription\Repositories\SubscriptionRepository',
            function () {
                $repository = new \Modules\Subscription\Repositories\Eloquent\EloquentSubscriptionRepository(new \Modules\Subscription\Entities\Subscription());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Subscription\Repositories\Cache\CacheSubscriptionDecorator($repository);
            }
        );
// add bindings




    }
}

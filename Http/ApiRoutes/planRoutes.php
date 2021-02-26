<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/plans'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  $router->post('/', [
    'as' => 'api.subscription.plans.store',
    'uses' => 'PlanApiController@create',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.subscription.plans.show',
    'uses' => 'PlanApiController@show',
  ]);
  $router->get('/', [
    'as' => 'api.subscription.plans.index',
    'uses' => 'PlanApiController@index',
  ]);
  $router->put('/{criteria}', [
  'as' => 'api.subscription.plans.update',
    'uses' => 'PlanApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.subscription.plans.delete',
    'uses' => 'PlanApiController@delete',
  ]);

});

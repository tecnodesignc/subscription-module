<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/features'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  $router->post('/', [
    'as' => 'api.subscription.features.store',
    'uses' => 'FeatureApiController@create',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.subscription.features.show',
    'uses' => 'FeatureApiController@show',
  ]);
  $router->get('/', [
    'as' => 'api.subscription.features.index',
    'uses' => 'FeatureApiController@index',
  ]);
  $router->put('/{criteria}', [
  'as' => 'api.subscription.features.update',
    'uses' => 'FeatureApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.subscription.features.delete',
    'uses' => 'FeatureApiController@delete',
  ]);

});

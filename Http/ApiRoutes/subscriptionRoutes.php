<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/subscription'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  $router->post('/', [
    'as' => 'api.subscription.subscription.store',
    'uses' => 'SuscriptionApiController@create',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.subscription.subscription.show',
    'uses' => 'SuscriptionApiController@show',
  ]);
  $router->get('/', [
    'as' => 'api.subscription.subscription.index',
    'uses' => 'SuscriptionApiController@index',
  ]);
  $router->put('/{criteria}', [
  'as' => 'api.subscription.subscription.update',
    'uses' => 'SuscriptionApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.subscription.subscription.delete',
    'uses' => 'SuscriptionApiController@delete',
  ]);

});

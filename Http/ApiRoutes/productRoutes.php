<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/products'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  $router->post('/', [
    'as' => 'api.subscription.products.store',
    'uses' => 'ProductApiController@create',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.subscription.products.show',
    'uses' => 'ProductApiController@show',
  ]);
  $router->get('/', [
    'as' => 'api.subscription.products.index',
    'uses' => 'ProductApiController@index',
  ]);
  $router->put('/{criteria}', [
  'as' => 'api.subscription.products.update',
    'uses' => 'ProductApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.subscription.products.delete',
    'uses' => 'ProductApiController@delete',
  ]);

});

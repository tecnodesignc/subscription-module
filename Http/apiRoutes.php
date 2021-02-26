<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' => '/subscription/v1'/*,'middleware' => ['auth:api']*/], function (Router $router) {
//======   Product
  require('ApiRoutes/productRoutes.php');
//======   Plan
  require('ApiRoutes/planRoutes.php');
//======   Feature
  require('ApiRoutes/featureRoutes.php');
//======   Suscription
  require('ApiRoutes/subscriptionRoutes.php');
});

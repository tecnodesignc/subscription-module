<?php

return [
    'subscription.products' => [
        'manage' => 'subscription::products.manage resource',
        'index' => 'subscription::products.list resource',
        'create' => 'subscription::products.create resource',
        'edit' => 'subscription::products.edit resource',
        'destroy' => 'subscription::products.destroy resource',
    ],
    'subscription.plans' => [
        'manage' => 'subscription::plans.manage resource',
        'index' => 'subscription::plans.list resource',
        'create' => 'subscription::plans.create resource',
        'edit' => 'subscription::plans.edit resource',
        'destroy' => 'subscription::plans.destroy resource',
    ],
    'subscription.features' => [
        'manage' => 'subscription::features.manage resource',
        'index' => 'subscription::features.list resource',
        'create' => 'subscription::features.create resource',
        'edit' => 'subscription::features.edit resource',
        'destroy' => 'subscription::features.destroy resource',
    ],
    'subscription.subscriptions' => [
        'manage' => 'subscription::subscriptions.manage resource',
        'index' => 'subscription::subscriptions.list resource',
        'create' => 'subscription::subscriptions.create resource',
        'edit' => 'subscription::subscriptions.edit resource',
        'destroy' => 'subscription::subscriptions.destroy resource',
    ],
// append




];

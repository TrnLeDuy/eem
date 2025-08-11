<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/product', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
    $router->get('categories', [
        'as' => 'api.product.category.indexServerSide',
        'uses' => 'CategoryApiController@indexServerSide',
        'middleware' => 'can:product.categories.index',
    ]);
    $router->get('categories/all', [
        'as' => 'api.product.category.all',
        'uses' => 'CategoryApiController@all',
        'middleware' => 'can:product.categories.index',
    ]);
    $router->get('categories/find', [
        'as' => 'api.product.category.find',
        'uses' => 'CategoryApiController@find',
        'middleware' => 'can:product.categories.index',
    ]);
    $router->post('categories/create', [
        'as' => 'api.product.category.store',
        'uses' => 'CategoryApiController@store',
        'middleware' => 'can:product.categories.create',
    ]);
    $router->post('categories/{categoryId}/update', [
        'as' => 'api.product.category.update',
        'uses' => 'CategoryApiController@update',
        'middleware' => 'can:product.categories.edit',
    ]);
    $router->delete('categories/{categoryId}/destroy', [
        'as' => 'api.product.category.destroy',
        'uses' => 'CategoryApiController@destroy',
        'middleware' => 'can:product.categories.destroy',
    ]);

    $router->get('products', [
        'as' => 'api.product.product.indexServerSide',
        'uses' => 'ProductApiController@indexServerSide',
        'middleware' => 'can:product.products.index',
    ]);
    $router->get('products/find', [
        'as' => 'api.product.product.find',
        'uses' => 'ProductApiController@find',
        'middleware' => 'can:product.products.index',
    ]);
    $router->post('products/create', [
        'as' => 'api.product.product.store',
        'uses' => 'ProductApiController@store',
        'middleware' => 'can:product.products.create',
    ]);
    $router->post('products/{productId}/update', [
        'as' => 'api.product.product.update',
        'uses' => 'ProductApiController@update',
        'middleware' => 'can:product.products.edit',
    ]);
    $router->delete('products/{productId}/destroy', [
        'as' => 'api.product.product.destroy',
        'uses' => 'ProductApiController@destroy',
        'middleware' => 'can:product.products.destroy',
    ]);
});






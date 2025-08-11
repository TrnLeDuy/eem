<?php
use Illuminate\Routing\Router;

$router->get('/san-pham/' . trans('product::products.router.search', ['search' => 'search']), [
    'as' => 'fe.product.product.search', 'uses' => 'FrontEnd\PublicController@search'
]);
$router->get('/san-pham/{slug}', ['as' => 'fe.product.product.detail', 'uses' => 'FrontEnd\PublicController@detail']);
$router->get('/san-pham/' . trans('product::products.router.category', ['category' => 'category']) . '/{slug}', ['as' => 'fe.product.product.category', 'uses' => 'FrontEnd\PublicController@getProductByCategory']);

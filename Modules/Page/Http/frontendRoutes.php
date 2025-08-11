<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('/', [
    'uses' => 'PublicController@homepage',
    'as' => 'homepage',
    'middleware' => config('asgard.page.config.middleware'),
]);
$router->any('{uri}', [
    'uses' => 'PublicController@uri',
    'as' => 'page',
    'middleware' => config('asgard.page.config.middleware'),
]);

$router->get('/category/{slug}', [
    'uses' => 'PublicController@getBlogsByCategory',
    'as' => 'category.posts',
    'middleware' => config('asgard.page.config.middleware'),
]);

$router->get('/blogs/search', [
    'uses' => 'PublicController@search',
    'as' => 'blogs.search',
    'middleware' => config('asgard.page.config.middleware'),
]);

$router->get('/tag/{slug}', [
    'uses' => 'PublicController@getPostsByTag',
    'as' => 'tag.posts',
    'middleware' => config('asgard.page.config.middleware'),
]);

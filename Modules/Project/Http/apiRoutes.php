<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/project', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
    $router->group(['prefix' => 'categories'], function (Router $router) {
        $router->get('/', [
            'as' => 'api.project.category.indexServerSide',
            'uses' => 'CategoryApiController@indexServerSide',
            'middleware' => 'token-can:project.categories.index',
        ]);
        $router->get('all', [
            'as' => 'api.project.category.all',
            'uses' => 'CategoryApiController@all',
            'middleware' => 'token-can:project.categories.index',
        ]);
        $router->get('find', [
            'as' => 'api.project.category.find',
            'uses' => 'CategoryApiController@find',
            'middleware' => 'token-can:project.categories.index',
        ]);
        $router->post('create', [
            'as' => 'api.project.category.store',
            'uses' => 'CategoryApiController@store',
            'middleware' => 'token-can:project.categories.create',
        ]);
        $router->post('{categoryId}/update', [
            'as' => 'api.project.category.update',
            'uses' => 'CategoryApiController@update',
            'middleware' => 'token-can:project.categories.edit',
        ]);
        $router->delete('{categoryId}/destroy', [
            'as' => 'api.project.category.destroy',
            'uses' => 'CategoryApiController@destroy',
            'middleware' => 'token-can:project.categories.destroy',
        ]);
    });

    $router->group(['prefix' => 'projects'], function (Router $router) {
        $router->get('/', [
            'as' => 'api.project.project.indexServerSide',
            'uses' => 'ProjectApiController@indexServerSide',
            'middleware' => 'token-can:project.projects.index',
        ]);
        $router->get('all', [
            'as' => 'api.project.project.all',
            'uses' => 'ProjectApiController@all',
            'middleware' => 'token-can:project.projects.index',
        ]);
        $router->get('find', [
            'as' => 'api.project.project.find',
            'uses' => 'ProjectApiController@find',
            'middleware' => 'token-can:project.projects.index',
        ]);
        $router->post('create', [
            'as' => 'api.project.project.store',
            'uses' => 'ProjectApiController@store',
            'middleware' => 'token-can:project.projects.create',
        ]);
        $router->post('{projectId}/update', [
            'as' => 'api.project.project.update',
            'uses' => 'ProjectApiController@update',
            'middleware' => 'token-can:project.projects.edit',
        ]);
        $router->delete('{projectId}/destroy', [
            'as' => 'api.project.project.destroy',
            'uses' => 'ProjectApiController@destroy',
            'middleware' => 'token-can:project.projects.destroy',
        ]);
    });
});






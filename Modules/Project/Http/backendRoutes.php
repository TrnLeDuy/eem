<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/project'], function (Router $router) {
    $router->bind('category', function ($id) {
        return app('Modules\Project\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.project.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:project.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.project.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:project.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.project.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:project.categories.create'
    ]);
    $router->get('categories/{category}/edit', [
        'as' => 'admin.project.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:project.categories.edit'
    ]);
    $router->put('categories/{category}', [
        'as' => 'admin.project.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:project.categories.edit'
    ]);
    $router->delete('categories/{category}', [
        'as' => 'admin.project.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:project.categories.destroy'
    ]);
    $router->bind('project', function ($id) {
        return app('Modules\Project\Repositories\ProjectRepository')->find($id);
    });
    $router->get('projects', [
        'as' => 'admin.project.project.index',
        'uses' => 'ProjectController@index',
        'middleware' => 'can:project.projects.index'
    ]);
    $router->get('projects/create', [
        'as' => 'admin.project.project.create',
        'uses' => 'ProjectController@create',
        'middleware' => 'can:project.projects.create'
    ]);
    $router->post('projects', [
        'as' => 'admin.project.project.store',
        'uses' => 'ProjectController@store',
        'middleware' => 'can:project.projects.create'
    ]);
    $router->get('projects/{project}/edit', [
        'as' => 'admin.project.project.edit',
        'uses' => 'ProjectController@edit',
        'middleware' => 'can:project.projects.edit'
    ]);
    $router->put('projects/{project}', [
        'as' => 'admin.project.project.update',
        'uses' => 'ProjectController@update',
        'middleware' => 'can:project.projects.edit'
    ]);
    $router->delete('projects/{project}', [
        'as' => 'admin.project.project.destroy',
        'uses' => 'ProjectController@destroy',
        'middleware' => 'can:project.projects.destroy'
    ]);
// append


});

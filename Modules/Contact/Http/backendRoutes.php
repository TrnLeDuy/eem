<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' => '/contact', 'middleware' => ['auth.admin']], function (Router $router) {
    $router->bind('category', function ($id) {
        return app('Modules\Contact\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.contact.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:contact.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.contact.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:contact.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.contact.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:contact.categories.create'
    ]);
    $router->get('categories/{categoryId}/edit', [
        'as' => 'admin.contact.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:contact.categories.edit'
    ]);
    $router->put('categories/{categoryId}', [
        'as' => 'admin.contact.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:contact.categories.edit'
    ]);
    $router->delete('categories/{categoryId}', [
        'as' => 'admin.contact.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:contact.categories.destroy'
    ]);
    $router->bind('contact', function ($id) {
        return app('Modules\Contact\Repositories\ContactRepository')->find($id);
    });
    $router->get('contacts', [
        'as' => 'admin.contact.contact.index',
        'uses' => 'ContactController@index',
        'middleware' => 'can:contact.contacts.index'
    ]);
    $router->get('contacts/create', [
        'as' => 'admin.contact.contact.create',
        'uses' => 'ContactController@create',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->post('contacts', [
        'as' => 'admin.contact.contact.store',
        'uses' => 'ContactController@store',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->get('contacts/{contact}/edit', [
        'as' => 'admin.contact.contact.edit',
        'uses' => 'ContactController@edit',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->put('contacts/{contact}', [
        'as' => 'admin.contact.contact.update',
        'uses' => 'ContactController@update',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->delete('contacts/{contact}', [
        'as' => 'admin.contact.contact.destroy',
        'uses' => 'ContactController@destroy',
        'middleware' => 'can:contact.contacts.destroy'
    ]);
// append



});

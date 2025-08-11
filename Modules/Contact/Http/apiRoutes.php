<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/contact', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
    $router->get('categories', [
        'as'=> 'api.contact.category.indexServerSide',
        'uses' => 'CategoryApiController@indexServerSide',
        'middleware' => 'can:contact.categories.index',
    ]);
    $router->get('categories/all', [
        'as'=> 'api.contact.category.all',
        'uses' => 'CategoryApiController@all',
        'middleware' => 'can:contact.categories.index',
    ]);
    $router->get('categories/find', [
        'as'=> 'api.contact.category.find',
        'uses' => 'CategoryApiController@find',
        'middleware' => 'can:contact.categories.index',
    ]);
    $router->post('categories/create', [
        'as'=> 'api.contact.category.store',
        'uses' => 'CategoryApiController@store',
        'middleware' => 'can:contact.categories.create',
    ]);
    $router->post('categories/{categoryId}/update', [
        'as'=> 'api.contact.category.update',
        'uses' => 'CategoryApiController@update',
        'middleware' => 'can:contact.categories.edit',
    ]);
    $router->delete('categories/{categoryId}/destroy', [
        'as'=> 'api.contact.category.destroy',
        'uses' => 'CategoryApiController@destroy',
        'middleware' => 'can:contact.categories.destroy',
    ]);

    $router->get('contacts', [
        'as' => 'api.contact.contact.indexServerSide',
        'uses' => 'ContactApiController@indexServerSide',
        'middleware' => 'can:contact.contacts.index'
    ]);
    $router->get('contacts/find', [
        'as' => 'api.contact.contact.find',
        'uses' => 'ContactApiController@find',
        'middleware' => 'can:contact.contacts.index'
    ]);
    $router->post('contacts/{contactId}/update', [
        'as' => 'api.contact.contact.update',
        'uses' => 'ContactApiController@update',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->delete('contacts/{contactId}/destroy', [
        'as' => 'api.contact.contact.destroy',
        'uses' => 'ContactApiController@destroy',
        'middleware' => 'can:contact.contacts.destroy'
    ]);
});
<?php

use Illuminate\Routing\Router;

$router->get('/'.trans('contact::contacts.contact'), 'FrontEnd\PublicController@contact')->name('fe.contact.contact.create');
$router->post('/store', 'FrontEnd\PublicApiController@store')->name('fe.contact.contact.store');

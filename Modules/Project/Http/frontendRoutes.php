<?php
use Illuminate\Routing\Router;

// $router->get('/du-an/' . trans('project::projects.router.search', ['search' => 'search']), [
//     'as' => 'fe.project.project.search', 'uses' => 'FrontEnd\PublicController@search'
// ]);
$router->get('/du-an/{slug}', ['as' => 'fe.project.project.detail', 'uses' => 'FrontEnd\PublicController@detail']);
// $router->get('/du-an/' . trans('project::projects.router.category', ['category' => 'category']) . '/{slug}', ['as' => 'fe.project.project.category', 'uses' => 'FrontEnd\PublicController@getProjectByCategory']);

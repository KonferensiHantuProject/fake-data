<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', ['uses' => 'HomeController@index']);

// User
$router->group(['prefix' => 'users'], function () use ($router){
    $router->get('/', ['uses' => 'API\UserController@index']);
    $router->get('/{id}', ['uses' => 'API\UserController@show']);
    $router->post('/', ['uses' => 'API\UserController@store']);
    $router->put('/{id}', ['uses' => 'API\UserController@update']);
    $router->delete('/{id}', ['uses' => 'API\UserController@delete']);
});
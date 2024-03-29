<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// user get a new token
$router->post('/auth/login', 'AuthController@authenticate');


// google maps distance api
$router->get('/distance', ['middleware' => 'jwt.auth', 'uses' => 'GeoController@distance']);
$router->get('/api/services', ['middleware' => 'jwt.auth', 'uses' => 'ServicesController@search']);
$router->get('/api/partner/availables', ['middleware' => 'jwt.auth', 'uses' => 'ServicesController@partners']);
$router->get('/developers', 'DocApiController@developers');
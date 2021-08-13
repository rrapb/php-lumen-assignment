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

$router->post('/login', 'AuthController@postLogin');

$router->post('/saveUser', 'UserController@save'); 

$router->group(['middleware'=>"auth"], function($router){
    
    $router->get('/getCurrentUser', 'UserController@getCurrentUser');
    $router->get('/getCurrentUserDetails', 'UserController@getCurrentUserDetails'); 
    $router->post('/savePost', 'PostController@store'); 
    $router->put('/updatePost', 'PostController@update');
    $router->delete('/deletePost', 'PostController@destroy');
    $router->post('/reply', 'ReplyController@store');
});
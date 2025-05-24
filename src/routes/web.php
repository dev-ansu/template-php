<?php

use app\core\Router;
use app\middlewares\AuthMiddleware;
use app\middlewares\CSRFMiddleware;

Router::group([
    'prefix' => '/dashboard',
    'middlewares' => [AuthMiddleware::class]
],function($route){
    $route('GET','', "dashboard\HomeController@index");
    $route('GET', "/usuarios", 'dashboard\UsuariosController@index');
});

Router::get("/", 'HomeController@index');
// Router::get("/dashboard", 'dashboard\HomeController@index', [AuthMIddleware::class]);

Router::get("/user/{id}", 'UserController@index');

Router::post("/login", 'LoginController@index', [CSRFMiddleware::class]);
Router::get("/logout", 'LoginController@logout');
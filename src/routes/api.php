<?php

use app\core\Router;
use app\middlewares\AuthMiddleware;

Router::group([
    'prefix' => '/api',
    'middlewares' => [AuthMiddleware::class]
],function($route){
    $route('GET', "/usuarios", 'api\UsuariosController@index');
});
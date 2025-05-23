<?php

use app\core\Router;

Router::get("/", 'HomeController@index');
Router::get("/dashboard", 'dashboard\HomeController@index');
Router::get("/user/{id}", 'UserController@index');
Router::post("/login", 'LoginController@index');
Router::get("/logout", 'LoginController@logout');
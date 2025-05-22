<?php

session_start();
date_default_timezone_set("America/Sao_Paulo");

define("CONTROLLERS_PATH", dirname(__DIR__) . "\\app\\controllers\\");

define("VIEWS_PATH", "app/views/");

define("COMPONENTS_PATH", "app\\views\\components\\");

define("BASE_URL", "http://localhost/template");

define("ASSETS_PATH", BASE_URL . "/assets");




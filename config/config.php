<?php

// Reforce a segurança dos cookies de sessão
ini_set('session.cookie_httponly', 1);     // Impede acesso por JavaScript
ini_set('session.use_strict_mode', 1);     // Evita aceitar IDs de sessão inválidos
ini_set('session.use_only_cookies', 1);    // Nunca usa ID de sessão pela URL
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Em produção, adicione esta linha (com HTTPS):
// ini_set('session.cookie_secure', 1);
session_start();
date_default_timezone_set("America/Sao_Paulo");

define("CONTROLLERS_PATH", dirname(__DIR__) . "\\app\\controllers\\");

define("VIEWS_PATH", "app/views/");

define("COMPONENTS_PATH", "app\\views\\components\\");

define("BASE_URL", 
    (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] === 'on' ? "https://":"http://")
    . $_SERVER['HTTP_HOST'] .
    rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']),"/")
);


define("ASSETS_PATH", BASE_URL . "/assets");
define("SESSION_LOGIN", "logado");




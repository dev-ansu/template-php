<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/config.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();

use app\core\Core;

$core = new Core();

$core->run();


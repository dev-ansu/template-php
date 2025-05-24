<?php


require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/config.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();
use app\core\Core;
use app\classes\ErrorHandler;
use DI\ContainerBuilder;

require_once __DIR__ . "/src/routes/web.php";
require_once __DIR__ . "/src/routes/api.php";

$builder = new ContainerBuilder();
$container = $builder->build();

$core = new Core($container);

try{

    $core->run();

}catch(\Exception $e){

    ErrorHandler::log($e); 
    http_response_code(500);
    echo "Erro interno do servidor (BD).";

}catch(\Throwable $e){
    ErrorHandler::log($e);
    http_response_code(500);
    echo "Erro interno do servidor.";
}



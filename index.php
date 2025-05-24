<?php


require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/config.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();
use app\core\Core;
use app\classes\ErrorHandler;
use app\contracts\AuthSessionService;
use app\contracts\Controller;
use app\core\Container;
use app\core\Controller as CoreController;

// use DI\ContainerBuilder;

require_once __DIR__ . "/src/routes/web.php";
require_once __DIR__ . "/src/routes/api.php";

$services = __DIR__ . "/app/core/services/services.php";
// $builder = new ContainerBuilder();
// $builder->addDefinitions($services);
// $container = $builder->build();

$container = new Container();
$container = $container->build();

$core = new Core($container);

try{

    $core->run();

}catch(\Exception $e){

    ErrorHandler::log($e); 
    http_response_code(500);
    echo $e->getLine();
    echo $e->getMessage();


}catch(\Throwable $e){
    ErrorHandler::log($e);
    ErrorHandler::handleException($e);
    http_response_code(500);

}



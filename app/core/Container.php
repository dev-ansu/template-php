<?php
namespace app\core;

use Di\Container as DIContainer;
use DI\ContainerBuilder;

use function DI\autowire;

class Container{
    
    public readonly DIContainer $container;
    private array $services;

    public function build(array $services = []){
        $this->load($services);
        $container = new ContainerBuilder();
        $container->addDefinitions(...$this->services);
        return $container->build();
    }

    public function bind(string $interface, string $class){
        $default = dirname(__DIR__) . "\core\services\services.php";
        $this->services[] = $default;
        $this->services[] = [$interface => autowire($class)];
    }

    public function load(array $services = []){
        $services_load = [];
       
        if(!empty($services)){
            foreach($services as $service){
                $this->services[] =  dirname(__DIR__) . "/core/services/$service.php";

            }    
        }

    }
}
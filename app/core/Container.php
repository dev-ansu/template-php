<?php
namespace app\core;

use Di\Container as DIContainer;
use DI\ContainerBuilder;

use function DI\autowire;

class Container{
    
    public readonly DIContainer $container;
    private array $services;

    public function build(array $services = []){
        $this->services = [];

        $this->load($services);
        $container = new ContainerBuilder();
        // Mescla todas as definições
        $definitions = [];
      
        foreach ($this->services as $service) {
            if (is_array($service)) {
                $definitions = array_merge($definitions, $service);
            } elseif (is_string($service) && file_exists($service)) {
                $loaded = require $service;
                if (is_array($loaded)) {
                    $definitions = array_merge($definitions, $loaded);
                }
            }
        }
 
        $container->addDefinitions($definitions);
        return $container->build();
    }

    public function bind(string $interface, string $class) {
        $this->services[] = [$interface => autowire($class)];
    }

    public function load(array $services = []) {
        if (!empty($services)) {
            foreach ($services as $service) {
                $path = dirname(__DIR__) . "/core/services/$service.php";
                if (file_exists($path)) {
                    $this->services[] = $path;
                }
            }    
        }
    }
}
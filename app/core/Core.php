<?php

namespace app\core;

use app\classes\NotFoundHandler;
use app\services\Request;
use DI\Container;

class Core{

    private string $controller = "app\\controllers\\HomeController";
    private string $method = 'index';
    private array $params = [];
 
    public function __construct(private Container $container)
    {
        $this->container = $container;
    }

    public function run(){
        // $url = $this->parseUrl();
        $url = implode("/", $this->parseUrl());
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $route = Router::resolve($url, $requestMethod);
     
        if(!$route){
            NotFoundHandler::handle();
            return;
        }
      
        // if(isset($url[1]) && file_exists(CONTROLLERS_PATH . $url[0] . "/". ucfirst($url[1]) . "Controller.php")){
            
            
        //     $this->controller = "app\\controllers\\" . $url[0] . "\\" . ucfirst($url[1]) . "Controller";
        //     array_shift($url); // remove subpasta
        //     array_shift($url); // remove o controller
      
            
        // }elseif(isset($url[0])){
         
        //     if(is_dir(CONTROLLERS_PATH . $url[0])){
                
        //         if(isset($url[1]) && file_exists(CONTROLLERS_PATH . $url[0] . "/". ucfirst($url[1]) . "Controller.php")){
        //             $this->controller = "app\\controllers\\" . $url[0] ."\\". ucfirst($url[1]) . "Controller";
        //         }elseif(isset($url[1]) && !file_exists(CONTROLLERS_PATH . $url[0] . "/". ucfirst($url[1]) . "Controller.php")){
        //             NotFoundHandler::handle();
        //             exit;
        //         }else{
        //             $this->controller = "app\\controllers\\" . $url[0] . "\\HomeController";
        //         }
        //     }elseif(!is_dir(CONTROLLERS_PATH . $url[0]) && file_exists(CONTROLLERS_PATH . ucfirst($url[0]) . "Controller.php")){
                
        //         $this->controller = "app\\controllers\\" . ucfirst($url[0]) . "Controller";
        //     }else{
        //         NotFoundHandler::handle();
        //         exit;
        //     }
                
            
        //     array_shift($url); // remove o controller
        // }
        // instância controller

        $this->controller = $route['controller'];
        $controller = $this->container->get($this->controller);
        $this->method = $route['method'];
        $this->params = $route['params'];
       
        // // verifica método
        // if(isset($url[0]) && method_exists($controllerInstance, $url[0])){
        //     $this->method = $url[0];
        //     array_shift($url);
        // }

        // Middlewares definidos na ROTA (executados primeiro)
        foreach ($route['middlewares'] ?? [] as $middleware) {
            $middlewareInstance = $this->container->get($middleware);
            if (!$middlewareInstance->handle()) {
                return;
            }
        }

        if($controller instanceof \app\contracts\MiddlewareProtected){
            $middlewares = $controller->middlewareMap();
            if(isset($middlewares[$this->method])){
                foreach($middlewares[$this->method] as $middleware){
                    if(is_array($middleware)){
                        [$middlewareClass, $params] = $middleware;
                        $middlewareClass::handle($params);
                    }else{
                        $middleware::handle();
                    }
                }
            }
        }

        // $this->params = $url;
    
        call_user_func_array([$controller, $this->method], $this->params);

    }

    private function parseUrl(): array {
        $url = $_SERVER['REQUEST_URI'];
        $basePath = parse_url(BASE_URL, PHP_URL_PATH);
        
        $base = $basePath ? rtrim($basePath, '/'):''; // Adapta para subdiretórios

        if($base !== ''){
            $basePattern = preg_quote($base, '#');
            $url = preg_replace("#^{$basePattern}#", "", $url);
        }
        $url = explode("?", $url)[0];
        $url = trim($url, "/");
        return $url ? array_filter(explode("/", $url)) : [];
    }
}
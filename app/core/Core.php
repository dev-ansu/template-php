<?php

namespace app\core;

class Core{

    private string $controller = "app\\controllers\\HomeController";
    private string $method = 'index';
    private array $params = [];

    public function run(){
        $url = $this->parseUrl();
      
        if(isset($url[1]) && file_exists(CONTROLLERS_PATH . $url[0] . "/". ucfirst($url[1]) . "Controller.php")){
            
 
            $this->controller = "app\\controllers\\" . $url[0] . "\\" . ucfirst($url[1]) . "Controller";
            array_shift($url); // remove subpasta
            array_shift($url); // remove o controller
      
            
        }elseif(isset($url[0])){

            if(is_dir(CONTROLLERS_PATH . $url[0])){
                if(isset($url[1]) && file_exists(CONTROLLERS_PATH . $url[0] . "/". ucfirst($url[1]) . "Controller.php")){
                    $this->controller = "app\\controllers\\" . $url[0] ."\\". ucfirst($url[1]) . "Controller";
                }else{
                    $this->controller = "app\\controllers\\" . $url[0] . "\\HomeController";
                }
            }elseif(!is_dir(CONTROLLERS_PATH . $url[0]) && file_exists(CONTROLLERS_PATH . ucfirst($url[0]) . "Controller.php")){
                $this->controller = "app\\controllers\\" . ucfirst($url[0]) . "Controller";
            }
    
            array_shift($url); // remove o controller
        }
        // instância controller

        $controllerInstance = new $this->controller;

        // verifica método
        if(isset($url[0]) && method_exists($controllerInstance, $url[0])){
            $this->method = $url[0];
            array_shift($url);
        }

        $this->params = $url;

        call_user_func_array([$controllerInstance, $this->method], $this->params);

    }

    private function parseUrl(): array {
        $url = $_SERVER['REQUEST_URI'];
        $base = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/');
        $url = preg_replace("#^$base#", "", $url); // remove a base do início
        $url = explode("?", $url)[0]; // remove query string;
        $url = trim($url, "/");
        return $url ? array_filter(explode("/", trim($url, "/"))): [];
    }
}
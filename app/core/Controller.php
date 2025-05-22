<?php

namespace app\core;

use Exception;

class Controller{
    
    public function load(string $viewName, array $viewData = []){
        
        try{
            $keys = array_keys($viewData);

            if(!in_array('view', $keys)){
                throw new Exception('É obrigatório passar uma view.');
            }
            
        
            if(!file_exists(VIEWS_PATH . $viewName . ".php")){
                throw new Exception('Não foi possível encontrar a view informada.');
            }

            extract($viewData);

            include  VIEWS_PATH . $viewName . ".php";

        }catch(Exception $e){
            
            echo $e->getMessage();

        }

        
    }

}
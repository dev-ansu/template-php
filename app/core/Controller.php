<?php

namespace app\core;

use app\classes\Session;
use Exception;

class Controller{
    
    public function load(string $viewName, array $viewData = []){

        $session = [];
        
        if((new Session)->has(SESSION_LOGIN) && !empty((new Session)->get(SESSION_LOGIN))){
            $session = Session::get(SESSION_LOGIN);
            $viewData['session'] = $session;
        }
        
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
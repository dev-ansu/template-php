<?php

namespace app\requests;

use app\classes\Validate;
use app\contracts\Request as ContractsRequest;

class Request extends Validate implements ContractsRequest{

    private $data;

    public function __construct(){
        self::$method = $_SERVER['REQUEST_METHOD'] === 'GET' ? $_GET : $_POST;
        self::$request = $this;
    }

    public function data(){
        return $this->data;
    }
    
    public function validated(){
        if(Validate::$request->authorize()){
            $validate = $this->validate(Validate::$request->rules());
            
            if(!$validate){
                self::setFlashMessages(); // Garante que as mensagens estarão disponíveis.
                return null;
            }

            $this->data = $validate;
            return $this;
        }else{
            setFlash('message', 'Você não tem autorização para esta ação.');
            redirect();
        }
    }

    public function errors(){
        return Validate::getErrors();
    }

}
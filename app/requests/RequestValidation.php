<?php

namespace app\requests;

use app\classes\Validate;
use app\facade\App;

class RequestValidation extends Validate{

    private $data;
    protected array $fields;

    public function __construct(){
        self::$method = App::request()->getServer('REQUEST_METHOD') === 'GET' ? $_GET : $_POST;
        self::$request = $this;
    }

    public function data(){
        return $this->data;
    }
    
    public function setFields(array $fields){
        $this->fields = $fields;
    }

    public function getFields(){
        return $this->fields;
    }

    public function setOld(){

        foreach($this->getFields() as $field){
            $value = App::request()->input($field);
            setOld($field, $value);
        }
        
    }
    
    public function validated(){
        if(Validate::$request->authorize()){
            
            $this->setFields(array_keys(Validate::$request->rules()));
       
            $validate = $this->validate(Validate::$request->rules());
            
            if(!$validate){
                $this->setOld();
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
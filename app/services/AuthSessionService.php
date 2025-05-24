<?php
namespace app\services;

use app\classes\Session;
use app\contracts\AuthSessionService as ContractsAuthSessionService;
use stdClass;

class AuthSessionService implements ContractsAuthSessionService{
    
    protected stdClass $data;

    public function __construct(protected Session $session)
    {
       
    }

    public function init(array| object $data){
       $this->session->__set(SESSION_LOGIN, $data);        
    }
    
    public function get(){
        $this->data = $this->session->__get(SESSION_LOGIN);         
        return $this->data;
    }

    public function end(){
        return $this->session->unset(SESSION_LOGIN);
    }

}
<?php
namespace app\services;

use app\classes\Session;
use stdClass;

class AuthSessionService{
    
    protected static Session $session;
    protected static stdClass $data;

    public function __construct()
    {
        self::$session = new Session;
    }

    public static function init(array| object $data){
       self::$session->__set(SESSION_LOGIN, $data);        
    }
    
    public static function get(){
        self::$data = self::$session->__get(SESSION_LOGIN);         
        return self::$data;
    }

    public static function end(){
        return self::$session->unset(SESSION_LOGIN);
    }

}
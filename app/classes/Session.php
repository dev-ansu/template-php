<?php
namespace app\classes;


class Session{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function __set($name = SESSION_LOGIN, $value)
    {
        session_regenerate_id(true);
        $_SESSION[$name] = $value;
    }

    public function __get($name)
    {
        return $_SESSION[$name] ?? null;
    }

    public static function get($name){
        return $_SESSION[$name] ?? null;
    }

    public function has($name){
        return isset($_SESSION[$name]);
    }

    public function unset($name){
        if($this->has($name)){
            unset($_SESSION[$name]);
        }
    }

}
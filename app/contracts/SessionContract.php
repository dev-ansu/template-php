<?php
namespace app\contracts;


interface SessionContract{


    public function __set($name, $value);

    public function __get($name);

    public static function get($name);

    public function has($name);

    public function unset($name);

}
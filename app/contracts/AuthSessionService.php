<?php
namespace app\contracts;


interface AuthSessionService{

    public function init(array| object $data);
    public function get();
    public function end();

}
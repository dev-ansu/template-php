<?php

namespace app\controllers;

use app\classes\CSRFToken;
use app\classes\Session;
use app\core\Controller;

class HomeController extends Controller{
    
    public function index(){
        $csrf = new CSRFToken();
        // (new Session)->unset(SESSION_LOGIN);
        $token = $csrf->getToken();
        $this->load('template-login', [
            'title' => 'Projeto',
            'token' => $token,
            'view' => 'login'
        ]);
    }

}
<?php

namespace app\controllers;

use app\classes\CSRFToken;
use app\core\Controller;

class HomeController extends Controller{
    
    public function index(){
        $csrf = new CSRFToken();
        $token = $csrf->getToken();
        $this->load('template', [
            'title' => 'Projeto',
            'token' => $token,
            'view' => 'index'
        ]);
    }

}
<?php

namespace app\controllers;

use app\core\Controller;
use app\core\DBManager;

class HomeController extends Controller{
    
    public function index(){

        $this->load('template', [
            'title' => 'Projeto',
            'view' => 'index'
        ]);
    }

}
<?php

namespace app\controllers\dashboard;

use app\classes\Session;
use app\contracts\MiddlewareProtected;
use app\core\Controller;
use app\middlewares\AuthMIddleware;
use app\middlewares\RoleMiddleware;

class UsuariosController extends Controller implements MiddlewareProtected{

    public function middlewareMap(): array
    {
        $session = (new Session)->__get(SESSION_LOGIN);
        
        return [
            'index' => [
                AuthMIddleware::class,
                [RoleMiddleware::class, ['editor']]
            ],
        ];
    }
    
    public function index(){
        $this->load('dashboard/template', [
            'title' => 'Usuários',
            'view' => 'dashboard/index'
        ]);
    }

}
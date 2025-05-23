<?php

namespace app\controllers;

use app\classes\CSRFToken;
use app\classes\Session;
use app\requests\LoginRequest;
use app\services\Auth\AuthService;

class LoginController{
    
    public function index(){
        $csrf = new CSRFToken();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_csrf_token'] ?? '';
                    
            if (!$csrf->validateToken($token)) {
                redirect();
                die('CSRF token inválido ou expirado!');
            }
            $request = (new LoginRequest)->validated();
           
            if(!$request){
                redirect();
                exit;
            }
            $data = $request->data();
            $user = (new AuthService)->execute($data);
            
            if(!$user){
                setFlash("message", 'E-mail ou senha incorretos.');
                redirect();
            }

            $session = new Session;
            $session->__set(SESSION_LOGIN, $user);
                        
            $csrf->invalidateToken();

            redirect("/dashboard");

        }
    }


    public function logout(){
        $session = new Session;
        $session->unset(SESSION_LOGIN);
        redirect("/");
    }

}
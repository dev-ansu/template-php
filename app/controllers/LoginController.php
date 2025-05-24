<?php

namespace app\controllers;

use app\classes\CSRFToken;
use app\core\Controller;
use app\requests\LoginRequest;
use app\services\Auth\AuthService;
use app\services\AuthSessionService;

class LoginController extends Controller{

    public function __construct(
        AuthSessionService $session,
        protected LoginRequest $loginRequest
    )
    {
        parent::__construct($session);   
    }
    
    public function index(){
        $csrf = new CSRFToken();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_csrf_token'] ?? '';
                    
            if (!$csrf->validateToken($token)) {
                redirect();
                die('CSRF token inválido ou expirado!');
            }
            $request = $this->loginRequest->validated();
           
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

            $this->session->init($user);
                        
            $csrf->invalidateToken();

            redirect("/dashboard");

        }
    }


    public function logout(){
        $this->session->end();
        redirect("/");
    }

}
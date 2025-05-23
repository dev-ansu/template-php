<?php

namespace app\controllers;

use app\classes\CSRFToken;

class LoginController{
    
    public function index(){
        $csrf = new CSRFToken();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_csrf_token'] ?? '';
                    
            if (!$csrf->validateToken($token)) {
                die('CSRF token inválido ou expirado!');
            }

            // Token válido — prossiga com o processamento
            echo 'Token válido!';
            $csrf->invalidateToken();
        }
    }

}
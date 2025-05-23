<?php
namespace app\middlewares;

use app\classes\Session;

class AuthMIddleware{


    public static function handle(){
        
        $session = new Session;
        // Verifica se a sessão possui o índice SESSION_LOGIN
        if(!$session->has(SESSION_LOGIN)){
            setFlash('message', 'Não autorizado');
            http_response_code(403);
            redirect();
            exit;
        } 

    }

}
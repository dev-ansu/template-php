<?php
namespace app\middlewares;

use app\classes\Session;

class RoleMiddleware{


    public static function handle(array $roles): void{
        
        $session = new Session;

        // Verifica se a sessão possui o índice SESSION_LOGIN
        
        if(!$session->has(SESSION_LOGIN)){
            setFlash('message', 'Não autorizado');
            http_response_code(403);
            redirect();
            exit;
        } 

        $user = $session->__get(SESSION_LOGIN);

        // Verifica se o usuário tem uma role permitida
        if(!$user || !isset($user->nivel) || !in_array($user->nivel, $roles)){
            setFlash('message', 'Não autorizado');

            if(isset($_SERVER['HTTP_REFERER'])){
                header("location:" . $_SERVER['HTTP_REFERER']);
                exit;
            }

            http_response_code(403);
            redirect();
            exit;
        }

    }

}
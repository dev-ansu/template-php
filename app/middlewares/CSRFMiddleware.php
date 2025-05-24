<?php
namespace app\middlewares;

use app\classes\CSRFToken;
use app\contracts\CSRFMiddlewareContract;
use app\facade\App;

class CSRFMiddleware implements CSRFMiddlewareContract{
    
    public function __construct(protected CSRFToken $csrftoken)
    {
        
    }

    public function handle(){
        
        if(!App::request()->isPost()){
            return true;
        }

        $token = App::request()->getPost($this->csrftoken->getTokenName());
        
        if(!$token || !$this->csrftoken->validateToken($token)){
            $this->denyAccess();
            return false;
        }

        return true;
    }

    protected function denyAccess(): void {
        setFlash('message', 'Token CSRF inválido ou expirado.');
        http_response_code(403);
        redirect("/");
    }
}
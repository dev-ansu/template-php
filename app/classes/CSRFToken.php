<?php
namespace app\classes;

use app\classes\Session;

class CSRFToken{
    
    protected $tokenName = "_csrf_token";
    protected $tokenExpiry = 3600; // 1 hora
    protected $session;

    public function __construct()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }    

        $this->session = new Session();

    }

    public function getTokenName(){
        return $this->tokenName; 
    }

    // Gera e armazena um token na sessão
    public function generateToken(): string{
        $token = bin2hex(random_bytes(32));
        $this->session->__set($this->tokenName, [
            'value' => $token,
            'time' => time()
        ]);   
        return $token;
    }

    // Retorna o token atual (ou gera um novo se não existir/expirou)
    public function getToken(): string{
        if((!$this->session->has($this->tokenName) || !isset($this->session->__get($this->tokenName)['time'])) || time() - $this->session->__get($this->tokenName)['time'] > $this->tokenExpiry
        ){
            return $this->generateToken();
        }
        return $this->session->__get($this->tokenName)['value'];
    }

    // Verifica se o token recebido é válido
    public function validateToken(string $token): string{
        if(
            isset($this->session->__get($this->tokenName)['value'])
            && hash_equals($this->session->__get($this->tokenName)['value'], $token)
        ){
            return true;
        }
        return false;
    }

    // Invalida o token atual
    public function invalidateToken(): void{
        $this->session->unset($this->tokenName);
    }
    
}
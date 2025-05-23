<?php

namespace app\services\Permissoes;

use app\classes\Session;
use app\core\DBManager;

class PermissoesService extends DBManager{
    
    protected $table = 'permissoes';
    protected $userId;
        
    public function __construct()
    {
        $session = new Session();

        $user = $session->__get(SESSION_LOGIN);

        if (!$user) {
            throw new \Exception("Usuário não autenticado.");
        }

        $this->userId = $user->id;
    }

    /**
     * Autenticar o usuário no sistema
     * @param array $data[$email, $senha]
     */
    public function getAllPermissions(){
        
        
        return [
            'editar',
        ];
    }

}
<?php

namespace app\services\usuarios;

use app\core\DBManager;

class UsuariosService extends DBManager{
    
    protected $table = 'usuarios';

    public function execute(string $email){
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
    }

}
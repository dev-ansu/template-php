<?php

namespace app\services\usuarios;

use app\core\DBManager;
use app\core\Model;

class UsuariosService extends Model{
    

    public function __construct(string | null $env = '')
    {
        $this->table = 'usuarios';
        $this->name = $env;
    }
}
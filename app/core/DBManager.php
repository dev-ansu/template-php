<?php

namespace app\core;

use Exception;
use PDO;

class DBManager{
    private static array $connections = [];

    public static function connection(string | null $name = null): PDO{
        $config = require __DIR__ ."/../../phinx.php";

        $name = !$name ? $config['environments']['default_environment']:$name;
        if(!isset(self::$connections[$name])){
            try{

                $conn = $config['environments'][$name] ?? null;
                
                if(!$conn){
                    throw new Exception("Configuração de conexão '$name' não encontrada.");
                }

                switch($conn['adapter']){
                    case 'mysql':
                        $dsn = "{$conn['adapter']}:host={$conn['host']};dbname={$conn['name']};port={$conn['port']};charset={$conn['charset']}";
                        self::$connections[$name] = new PDO($dsn, $conn['user'], $conn['pass']);
                    break;
                    
                    case 'sqlite':
                        $dsn = "sqlite:{$conn['path']}";
                        self::$connections[$name] = new PDO($dsn);
                    break;

                    default:
                        throw new Exception("Driver '{$conn['driver']}' não suportado.");
                }

                self::$connections[$name]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connections[$name]->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$connections[$name]->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        return self::$connections[$name];
    }
}
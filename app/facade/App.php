<?php
namespace app\facade;

use app\classes\Session;
use app\services\AuthSessionService;
use app\services\Request;
use DI\Container;

class App{
    private static Container $container;

    /**
     * Define o container usado pela aplicação
     */

     public static function setContainer(Container $container): void{
        self::$container = $container;
     }
     
     /**
      * Recupera um serviço qualquer pelo ID ou nome da classe
      */
      public static function get(string $id):mixed{
        return self::$container->get($id);
      }

      /**
       * Atalho para o serviço da sessão
       */
      public static function authSession(): AuthSessionService{
        return self::get(AuthSessionService::class);
      }

      public static function request(): Request{
        return self::get(Request::class);
      }

      public static function session(): Session{
        return self::get(Session::class);
      }

      
}
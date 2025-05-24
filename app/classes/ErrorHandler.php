<?php
namespace app\classes;

use Error;
use ErrorException;
use Throwable;

class ErrorHandler{
    
    public static function register(){
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleException(Throwable $e){
        error_log($e);
        http_response_code(500);
          $linha = $e->getLine();
        $mensagem = $e->getMessage();
        $arquivo = $e->getFile();
        $traceAsString = $e->getTraceAsString();
        echo <<<HTML
            <p>Erro na linha: {$linha} do arquivo {$arquivo}
            <p>Mensagem: {$mensagem}</p>
            <p>Stacktrace: {$traceAsString}</p>
        HTML;
    }

    public static function handleError($severity, $message, $file, $line){
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    public static function log(Throwable $e):void{
        $message = sprintf(
            "[%s] %s in %s:%d\nTrace:\n%s\n\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );
        file_put_contents(dirname(__DIR__ . "/../../logs/error.log"), $message, FILE_APPEND);
    }

    public static function handleShutdown()
    {
        $error = error_get_last();
        if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            $e = new \ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
            self::log($e);

            if (http_response_code() === 200) {
                http_response_code(500);
            }
            echo "Erro fatal.";
        }
    }
}
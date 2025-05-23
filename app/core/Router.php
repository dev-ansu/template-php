<?php
namespace app\core;


class Router{
    private static array $routes = [];
    
    public static function get(string $route, string $action):void{
        self::$routes['GET'][$route] = $action;
    }

    public static function post(string $route, string $action): void{
        self::$routes['POST'][$route] = $action;
    }

    public static function resolve(string $url, string $requestMethod): ?array{
    
        foreach(self::$routes[$requestMethod] as $route => $action){
            // Converte "{id:\d+}" em "(?P<id>\d+)" e "{slug}" em "(?P<slug>[^/]+)"
            $pattern = preg_replace_callback(
                '/\{(\w+)(?::([^}]+))?\}/',
                function ($matches) {
                    $paramName = $matches[1];
                    $regexPattern = $matches[2] ?? '[^/]+'; // Padrão padrão: qualquer coisa exceto /
                    return "(?P<{$paramName}>{$regexPattern})";
                },
                ltrim($route, '/')
            );

            $pattern = "#^{$pattern}$#";
           
            if(preg_match($pattern, $url, $matches)){
                // Filtra apenas os parâmetros nomeados (ex: 'id' => '123')
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                array_shift($matches);
                [$controller, $method] = explode("@", $action);
                return [
                    'controller' => "app\\controllers\\" . $controller,
                    'method' => $method,
                    'params' => $params
                ];
            }
        }
        return null;
    }
}
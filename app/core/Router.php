<?php
namespace app\core;


class Router{
    
    private static array $routes = [];
    
    
    public static function get(string $route, string $action, array $middlewares = []):void{
        self::$routes['GET'][$route] = [
         'action' =>  $action,
         'middlewares' => $middlewares
        ];
    }

    public static function post(string $route, string $action, array $middlewares = []): void{
        self::$routes['POST'][$route] = [
            'action' =>  $action,
            'middlewares' => $middlewares
        ];
    }

    public static function group(array $options, callable $callback): void{
        $middlewares = $options['middlewares'] ?? [];
        $prefix = $options['prefix'] ?? '';

        //Executa o callback (onde as rotas são definidas) com as opções do grupo
        $callback(function (string $method, string $route, string $action, array $routeMiddlewares = []) use ($prefix, $middlewares){
            $fullRoute = $prefix . $route;
            $combinedMiddlewares = array_merge($middlewares, $routeMiddlewares);

            // Registra a rota com os middlewares combinados
            self::$routes[strtoupper($method)][$fullRoute] = [
                "action" => $action,
                'middlewares' => $combinedMiddlewares
            ];
        });
    }

    public static function resolve(string $url, string $requestMethod): ?array{
        
        foreach(self::$routes[$requestMethod] as $route => $action){
          
            // Converte "{id:\d+}" em "(?P<id>\d+)" e "{slug}" em "(?P<slug>[^/]+)"
            // Converte uma rota com parâmetros nomeados (ex.: /user/{id}) em uma expressão regular.
            // A regex resultante permite extrair os valores dos parâmetros da URL real
            $pattern = preg_replace_callback(
                '/\{(\w+)(?::([^}]+))?\}/',
                function ($matches) {
                    $paramName = $matches[1]; // Nome do parâmetro (ex.: id)
                    $regexPattern = $matches[2] ?? '[^/]+'; // Se não houver regex definida, aceita qualquer coisa menos "/"
                    return "(?P<{$paramName}>{$regexPattern})"; // Cria o grupo para capturar o valor da URL
                },
                ltrim($route, '/') // Remove a barra inicial da rota
            );
            // Finaliza o padrão regex adicionando delimitadores e âncoras de início/fim.
            $pattern = "#^{$pattern}$#";
            
            if(preg_match($pattern, $url, $matches)){
                // Filtra apenas os parâmetros nomeados (ex: 'id' => '123')
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                array_shift($matches);
                
                [$controller, $method] = explode("@", $action['action']);

                return [
                    'controller' => "app\\controllers\\" . $controller,
                    'method' => $method,
                    'params' => $params,
                    'middlewares' => $action['middlewares']
                ];
            }
        }
        return null;
    }
}
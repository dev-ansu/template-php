<?php
namespace app\contracts;

interface MiddlewareProtected{
    /**
     * Retorna uma lista de middlewares por método
     * Ex: return ['editar' => [AuthMiddleware::class]]
     */
    public function middlewareMap(): array;

}
<?php
namespace app\contracts;

interface RequestContract{
    

    public static function create(): static;
    
    public function getQuery(string $key, $default = null);

    public function getPost(string $key, $default = null);

    public function getServer(string $key, $default = null);

    public function getSession(string $key, $default = null);

    public function isGet():bool;

    public function isPost():bool;

    public function isAjax(): bool;

    public function getJsonBody(): ?array;

    public function input(string $key, $default = null);


}
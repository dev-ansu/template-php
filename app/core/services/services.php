<?php

use app\contracts\AuthSessionService;
use app\contracts\RequestContract;
use app\services\AuthSessionService as ServicesAuthSessionService;
use app\services\Request;

use function DI\autowire;
use function DI\factory;

return [
    AuthSessionService::class => autowire(ServicesAuthSessionService::class),
    Request::class => Request::create(),
];
<?php

use app\classes\CSRFToken;
use app\classes\Session;
use app\contracts\SessionContract;
use app\contracts\AuthSessionService;
use app\contracts\CSRFMiddlewareContract;
use app\middlewares\CSRFMiddleware;
use app\services\AuthSessionService as ServicesAuthSessionService;
use app\services\Request;

use function DI\autowire;


return [
    SessionContract::class => autowire(Session::class),
    AuthSessionService::class => autowire(ServicesAuthSessionService::class),
    CSRFMiddlewareContract::class => autowire(CSRFMiddleware::class),
    Request::class => Request::create(),    
];
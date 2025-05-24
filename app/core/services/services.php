<?php

use app\contracts\AuthSessionService;
use app\contracts\Controller;
use app\core\Controller as CoreController;
use app\contracts\Request;
use app\requests\Request as RequestsRequest;
use app\services\AuthSessionService as ServicesAuthSessionService;

use function DI\autowire;

return [
    AuthSessionService::class => autowire(ServicesAuthSessionService::class),
    Controller::class, CoreController::class,
    Request::class => autowire(RequestsRequest::class),
];
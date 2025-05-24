<?php

use app\contracts\Controller;
use app\contracts\Request;
use app\core\Controller as CoreController;
use app\requests\Request as RequestsRequest;

use function DI\autowire;

return [
    Request::class => RequestsRequest::class,
    Controller::class => autowire(CoreController::class),
];
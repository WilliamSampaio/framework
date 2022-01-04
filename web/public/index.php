<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use WEB\Controllers\InicioController;
use Middleware\GetSubdomainMiddleware;

require_once __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, false, false);

$app->setBasePath('/web/public');

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Olá mundo! Sou uma Aplicação WEB!");
    return $response;
});

$app->get('/inicio', InicioController::class . ':inicio');

$app->run();

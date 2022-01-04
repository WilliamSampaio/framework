<?php

use API\Controllers\AuthController;
use API\Controllers\UserController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, false, false);

// Path padrão para o entrypoint
$app->setBasePath('/api/public');

// Agrupa as rotas a versão 1 da API
$app->group('/v1', function (RouteCollectorProxy $group) {

    // Rota para teste
    $group->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write(json_encode(["api-response" => "Olá! Tudo bem?"]));
        return $response;
    });

    // Rota de login
    $group->post('/login', AuthController::class . ':login');

    // Rota para criar novo token valido
    $group->post('/refresh-token', AuthController::class . ':refreshToken');
});

$app->run();

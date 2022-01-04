<?php

namespace WEB\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class InicioController
{
    public function inicio(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write('<h1>INICIO...' . WEB_APP . '</h1>');
        return $response;
    }
}

<?php

namespace Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class GetSubdomainMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);

        $host = $request->getUri()->getHost();

        if (filter_var($host, FILTER_VALIDATE_IP))
            return new Response();

        $subdomain = explode('.', $host)[0];

        $response = new Response();

        $response->getBody()->write($subdomain);

        return $response;
    }
}

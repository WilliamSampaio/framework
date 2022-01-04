<?php

namespace API\Controllers;

use API\Models\TokenModel;
use API\Models\UsuarioModel;
use DateTime;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

class AuthController
{
    public function login(Request $request, Response $response, array $args): Response
    {
        $email = $this->postDataExtractor($request, 'email');
        $senha = $this->postDataExtractor($request, 'senha');
        
        $expired_at = (new DateTime())->modify('+1 day')->format('Y-m-d H:i:s');

        $usuario = (new UsuarioModel)->find("email = :email", "email=$email")->fetch();

        if(is_null($usuario)){
            $response->getBody()->write(json_encode(['erro' => 'acesso negado']));
            return $response->withStatus(401);
        }

        if($usuario->senha != md5($senha)){
            $response->getBody()->write(json_encode(['erro' => 'acesso negado']));
            return $response->withStatus(401);
        }

        $token = $this->tokenGenerator([
            "sub" => $usuario->id,
            "email" => $usuario->email,
            "nome" => $usuario->nome,
            "expired_at" => $expired_at
        ]);

        $tokenRefresh = $this->tokenGenerator([
            "email" => $usuario->email,
            "random" => uniqid()
        ]);

        $this->addToken($token, $tokenRefresh, $expired_at);

        $response->getBody()->write(json_encode([
            "token" => $token,
            "token_refresh" => $tokenRefresh
        ]));

        return $response;
    }

    public function refreshToken(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write('oi');
        return $response;
    }

    private function postDataExtractor(Request $request, string $index = null)
    {
        return is_null($index)? json_decode($request->getBody(), true) : json_decode($request->getBody(), true)[$index];
    }

    private function tokenGenerator(array $payload): string
    {
        return JWT::encode($payload, JWT_SECRET_KEY);
    }

    private function addToken(string $token, string $token_refresh, string $expired_at): bool
    {
        $newToken = new TokenModel;
        $newToken->token = $token;
        $newToken->token_refresh = $token_refresh;
        $newToken->expired_at = $expired_at;
        return $newToken->save();
    }

}

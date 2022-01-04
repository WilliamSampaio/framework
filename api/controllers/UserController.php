<?php

namespace API\Controllers;

use API\Models\UsuarioModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    public function getUser(Request $request, Response $response, array $args): Response
    {
        $model = new UsuarioModel();

        if (isset($args['id'])) {
            $id = $args['id'];
            $data = $model->findById((int)$id)->data();
        } else {
            $usuarios = $model->find()->fetch(true);

            foreach($usuarios as $user){
                $data[] = $user->data();
            }
        }

        $response->getBody()->write(json_encode($data));
        return $response;
    }
}

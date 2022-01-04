<?php

namespace API\Models;

use CoffeeCode\DataLayer\DataLayer;

class UsuarioModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("usuario", ["nome", "email", "senha"], 'id', true);
    }
}

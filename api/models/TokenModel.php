<?php

namespace API\Models;

use CoffeeCode\DataLayer\DataLayer;

class TokenModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("token", ["token", "token_refresh", "expired_at"], 'id', true);
    }
}

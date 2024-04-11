<?php

namespace app\core\middlewares;

use app\core\App;
use app\core\exceptions\ForbiddenException;

class RoleMiddleware extends Middleware
{
    protected array $roles = [];

    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    public function execute()
    {


        if (empty($this->roles)) {
            return;
        }

        if (!App::isGuest() && App::userHasRole($this->roles)) {
            return;
        }

        throw new ForbiddenException();
    }
}

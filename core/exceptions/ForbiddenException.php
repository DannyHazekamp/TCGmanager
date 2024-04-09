<?php

namespace app\core\exceptions;

use app\core\App;

class ForbiddenException extends \Exception
{
    protected $message = ' Forbidden';
    protected $code = 403;
}
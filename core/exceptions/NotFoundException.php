<?php

namespace app\core\exceptions;

use app\core\App;

class NotFoundException extends \Exception
{
    protected $message = ' Not found';
    protected $code = 404;
}
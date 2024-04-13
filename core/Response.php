<?php

namespace app\core;

class Response
{
    // sets the status code
    public function setStatus(int $code)
    {
        http_response_code($code);
    }

    // handles redirections
    public function redirect(string $url)
    {
        header('Location: ' . $url);
    }
}

<?php

namespace app\core;

class Request
{
    private array $routeParams = [];

    // gets the current path
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    // returns the http method of the request
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    // checks if the request method is GET
    public function is_method_get()
    {
        return $this->method() === 'get';
    }

    // checks if the request method is POST
    public function is_method_post()
    {
        return $this->method() === 'post';
    }

    // gets input data from the request body
    public function getBody()
    {
        $body = [];

        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    // checks to see if a file was uploaded
    public function getFile($name)
    {
        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        }
        return null;
    }

    // sets route parameters
    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    // gets route parameters
    public function getRouteParams()
    {
        return $this->routeParams;
    }
}

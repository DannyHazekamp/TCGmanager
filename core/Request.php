<?php

namespace app\core;

class Request 
{
    private array $routeParams = [];

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if($position !== false ) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function is_method_get() 
    {
        return $this->method() === 'get';
    }

    public function is_method_post()
    {
        return $this->method() === 'post';
    }

    public function getBody()
    {   
        $body = [];

        if($this->method() === 'get'){
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->method() === 'post'){
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public function getFile($name)
    {
        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        }
        return null;
    }

    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
}
<?php

namespace app\core;


class Router 
{
    public Request $request;
    public Response $response;
    protected array $routes = [];


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatus(404);
            return $this->render("_404"); 
        }
        if(is_string($callback)) {
            return $this->render($callback);
        }
        if (is_array($callback)) {
            $callback[0] = new $callback[0];
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function render($view, $params = [])
    {

        $content = $this->content();
        $viewContent = $this->renderView($view, $params);
        return str_replace('{{content}}', $viewContent, $content);
    }

    public function renderContent($viewContent)
    {
        $content = $this->content();
        return str_replace('{{content}}', $viewContent, $content);
    }

    protected function content() 
    {
        ob_start();
        include_once App::$ROOT_DIRECTORY . "/views/layouts/main.php";; 
        return ob_get_clean();
    }

    protected function renderView($view, $params) 
    {
        foreach($params as $key => $value) {
            $$key = $value;
        }
        $viewPath = str_replace('.', '/', $view);

        ob_start();
        include_once App::$ROOT_DIRECTORY."/views/$viewPath.php"; 
        return ob_get_clean();
    }

}
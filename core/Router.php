<?php

namespace app\core;

use app\core\exceptions\ForbiddenException;
use app\core\exceptions\NotFoundException;

class Router 
{
    public Request $request;
    public Response $response;
    public Session $session;
    protected array $routes = [];


    public function __construct(Request $request, Response $response, Session $session)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
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

        foreach ($this->routes[$method] as $route => $callback) {

            $pattern = preg_replace('/\/{(.*?)}/', '/(.*?)', $route);
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                
                $routeParams = [];
                preg_match_all('/{(.*?)}/', $route, $routeParamsMatches);
                $routeParamsNames = $routeParamsMatches[1];
                for ($i = 0; $i < count($routeParamsNames); $i++) {
                    $routeParams[$routeParamsNames[$i]] = $matches[$i];
                }
                
                $this->request->setRouteParams($routeParams);

                if (is_string($callback)) {
                    return $this->render($callback);
                }
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    App::$app->controller = $controller;
                    $controller->action = $callback[1];
                    $callback[0] = $controller;

                    foreach ($controller->getMiddlewares() as $middleware) {
                        $middleware->execute();
                    }

                    if (isset($controller->role) && !App::userHasRole([$controller->role])) {
                        throw new ForbiddenException();
                    }
                }
                return call_user_func($callback, $this->request, $this->response, $this->session);
            }
        }

        throw new NotFoundException(); 
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
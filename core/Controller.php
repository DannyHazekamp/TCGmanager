<?php

namespace app\core;

use app\core\middlewares\Middleware;

class Controller
{
    protected array $middlewares = [];


    // renders the views
    public function render($view, $params = [])
    {
        return App::$app->router->render($view, $params);
    }

    // registers the middleware
    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    // gets the middlewares
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


    // used to provide role middleware to specific controller methods
    public function only(array $actions): self
    {
        $middlewares = $this->middlewares;
        $this->middlewares = [];

        foreach ($middlewares as $middleware) {
            $middleware->actions = $actions;
            $this->middlewares[] = $middleware;
        }

        return $this;
    }
}

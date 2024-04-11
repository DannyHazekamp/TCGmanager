<?php

namespace app\core;

use app\core\middlewares\Middleware;

class Controller
{
    protected array $middlewares = [];


    public function render($view, $params = [])
    {
        return App::$app->router->render($view, $params);
    }

    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

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

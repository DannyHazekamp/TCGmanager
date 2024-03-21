<?php

namespace app\core;


class Controller 
{
    public function render($view, $params = [])
    {
        return App::$app->router->render($view, $params);
    }

}
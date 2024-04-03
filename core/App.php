<?php

namespace app\core;

class App 
{
    public static string $ROOT_DIRECTORY;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public static App $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIRECTORY = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database();
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
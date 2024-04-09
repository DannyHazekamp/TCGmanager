<?php

namespace app\core;

use app\models\User;

class App 
{
    public static string $ROOT_DIRECTORY;
    public static App $app;


    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Session $session;
    public Database $db;
    public ?DbModel $user;
    public string $userClass;

    public function __construct($rootPath, string $userClass = User::class)
    {
        self::$ROOT_DIRECTORY = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->userClass = $userClass;

        $this->db = new Database();

        $userValue = $this->session->get('user');
        if($userValue) {
            $userId = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$userId => $userValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try{
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatus($e->getCode());
            echo $this->router->render('_error', [
                'exception' => $e
            ]);
        }
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $userId = $user->primaryKey();
        $userValue = $user->{$userId};
        $this->session->set('user', $userValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->delete('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public static function getUser(): ?User
    {
        return self::$app->user;
    }

    public static function userHasRole(array $roles): bool
    {
        return !self::isGuest() && self::getUser()->hasRole($roles);
    }
}
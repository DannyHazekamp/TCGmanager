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
        $this->router = new Router($this->request, $this->response, $this->session);
        $this->userClass = $userClass;

        $this->db = new Database();

        // checks if a user is logged in already
        $userValue = $this->session->get('user');
        if ($userValue) {
            $userId = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$userId => $userValue]);
        } else {
            $this->user = null;
        }
    }

    // Makes the app run with the routing
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatus($e->getCode());
            echo $this->router->render('_error', [
                'exception' => $e
            ]);
        }
    }

    // manages login and sets the user in the session
    public function login(DbModel $user)
    {
        $this->user = $user;
        $userId = $user->primaryKey();
        $userValue = $user->{$userId};
        $this->session->set('user', $userValue);
        return true;
    }

    // manages logout and deletes the user from the session
    public function logout()
    {
        $this->user = null;
        $this->session->delete('user');
    }

    // checks if the user is logged in
    public static function isGuest()
    {
        return !self::$app->user;
    }

    // returns the logged in user
    public static function getUser(): ?User
    {
        return self::$app->user;
    }

    // checks if the user has a specific role (used in RoleMiddleware)
    public static function userHasRole(array $roles): bool
    {
        return !self::isGuest() && self::getUser()->hasRole($roles);
    }
}

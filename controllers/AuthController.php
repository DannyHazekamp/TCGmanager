<?php

namespace app\controllers;

use app\core\App;
use app\models\User;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\core\Controller;
use app\models\LoginModel;
use app\core\middlewares\RoleMiddleware;

class AuthController extends Controller
{
    // registers the middleware for quests only on login and register
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware([]))->only(['login', 'register']);
    }

    // register for quests
    public function register(Request $request, Response $response, Session $session)
    {
        if (!App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $user = new User();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        $user->role_id = 2;

        if ($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                $session->setMessage('success', 'Successfully registered');
                $response->redirect('/login');
                return;
            }
            return $this->render('auth.register', [
                'user' => $user
            ]);
        }
        return $this->render('auth.register', [
            'user' => $user
        ]);
    }

    // login for registered users
    public function login(Request $request, Response $response, Session $session)
    {
        if (!App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $loginModel = new LoginModel();

        $loginModel->email = '';
        $loginModel->password = '';

        if ($request->is_method_post()) {
            $loginModel->loadData($request->getBody());
            if ($loginModel->validate() && $loginModel->login()) {
                $session->setMessage('success', 'Logged in, welcome!');
                $response->redirect('/');
                return;
            }
        }
        return $this->render('auth.login', [
            'loginModel' => $loginModel
        ]);
    }

    // logout for logged in users
    public function logout(Request $request, Response $response, Session $session)
    {
        App::$app->logout();
        $session->setMessage('danger', 'Logged out');
        $response->redirect('/login');
        return;
    }
}

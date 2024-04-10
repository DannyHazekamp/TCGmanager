<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\middlewares\RoleMiddleware;
use app\models\User;
use app\core\Response;
use app\core\Session;
use app\core\App;
use app\models\LoginModel;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware([]))->only(['login', 'register']);
    }

    public function register(Request $request, Response $response, Session $session)
    {
        $user = new User();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        $user->role_id = 2;
        
        if($request->is_method_post()){
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->save()){
                $session->setMessage('success', 'Successfully registered');
                $response->redirect('/login');
            }
            return $this->render('auth.register', [
                'model' => $user
            ]);
        }
        return $this->render('auth.register', [
            'model' => $user
        ]);
    }

    public function login(Request $request, Response $response, Session $session) 
    {
        $loginModel = new LoginModel();

        $loginModel->email = '';
        $loginModel->password = '';

        if($request->is_method_post()) {
            $loginModel->loadData($request->getBody());
            if($loginModel->validate() && $loginModel->login()) {
                $session->setMessage('success', 'Logged in, welcome!');
                $response->redirect('/');
            }
        }
        return $this->render('auth.login', [
            'model' => $loginModel
        ]);
    }

    public function logout(Request $request, Response $response, Session $session)
    {
        App::$app->logout();
        $session->setMessage('danger', 'Logged out');
        $response->redirect('/login');
    }
}
<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\middlewares\RoleMiddleware;
use app\models\User;
use app\core\Response;
use app\core\App;
use app\models\LoginModel;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware([]))->only(['login', 'register']);
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        $user->role_id = 2;
        
        if($request->is_method_post()){
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->save()){
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

    public function login(Request $request, Response $response) 
    {
        $loginModel = new LoginModel();

        $loginModel->email = '';
        $loginModel->password = '';

        if($request->is_method_post()) {
            $loginModel->loadData($request->getBody());
            if($loginModel->validate() && $loginModel->login()) {
                $response->redirect('/');
            }
        }
        return $this->render('auth.login', [
            'model' => $loginModel
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        App::$app->logout();
        $response->redirect('/login');
    }
}
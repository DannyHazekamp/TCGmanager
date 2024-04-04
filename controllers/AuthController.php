<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\core\Response;
use app\core\App;
use app\models\LoginModel;

class AuthController extends Controller
{

    public function register(Request $request, Response $response)
    {
        $user = new User();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        if($request->is_method_post()){
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->save()){
                $response->redirect('/');
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function login(Request $request, Response $response) 
    {
        $loginModel = new LoginModel();
        if($request->is_method_post()) {
            $loginModel->loadData($request->getBody());
            if($loginModel->validate() && $loginModel->login()) {
                $response->redirect('/');
            }
        }
        return $this->render('login', [
            'model' => $loginModel
        ]);
    }
}
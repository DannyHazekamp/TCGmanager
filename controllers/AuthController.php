<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        $registerModel->username = '';
        $registerModel->email = '';
        $registerModel->password = '';
        if($request->is_method_post()){
            $registerModel->loadData($request->getBody());
            
            if($registerModel->validate() && $registerModel->register()){
                return 'Success';
            }
            return $this->render('register', [
                'model' => $registerModel
            ]);
        }
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function login() 
    {
        return $this->render('login');
    }
}
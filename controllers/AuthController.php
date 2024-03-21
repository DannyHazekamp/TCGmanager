<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if($request->is_method_post()){
            return 'Handle submitted register';
        }
        return $this->render('register');
    }

    public function login() 
    {
        return $this->render('login');
    }
}
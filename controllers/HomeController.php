<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'Danny'
        ];

        return $this->render('home', $params);
    }
}
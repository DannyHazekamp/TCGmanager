<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\middlewares\RoleMiddleware;
use app\models\Card;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['user', 'premium_user', 'admin']));
    }

    public function home()
    {
        $cards = Card::findAll();

        return $this->render('home', [
            'cards' => $cards
        ]);
    }
}
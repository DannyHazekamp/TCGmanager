<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\models\Card;

class HomeController extends Controller
{
    public function home()
    {
        $cards = Card::findAll();

        return $this->render('home', [
            'cards' => $cards
        ]);
    }
}
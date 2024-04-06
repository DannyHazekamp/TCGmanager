<?php

namespace app\controllers;

use app\core\Controller;


class CardController extends Controller
{

    public function show()
    {
        return $this->render('card.show');
    }
}
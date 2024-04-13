<?php

namespace app\controllers;

use app\models\Card;
use app\core\Request;
use app\core\Controller;
use app\core\middlewares\RoleMiddleware;

class CardController extends Controller
{
    // registers middleware for all roles
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['user', 'premium_user', 'admin']));
    }

    // card show
    public function show(Request $request)
    {
        $params = $request->getRouteParams();
        $card_id = $params['id'];

        $card = Card::findOne(['card_id' => $card_id]);

        return $this->render('card.show', [
            'card' => $card
        ]);
    }
}

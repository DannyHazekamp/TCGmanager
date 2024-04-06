<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Card;

class CardController extends Controller
{

    public function show(Request $request, Response $response)
    {   
        $params = $request->getRouteParams();
        $card_id = $params['id'];

        $card = Card::findOne(['card_id' => $card_id]);

        return $this->render('card.show', [
            'card' => $card
        ]);
    }
}
<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
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

    public function search(Request $request, Response $response)
    {
        if($request->is_method_get()) {
            $query = $request->getBody()['search'] ?? '';

            if(!empty($query)) {
            $cards = Card::searchAll(['name' => $query]);
            } else {
                $cards = Card::findAll();
            }

            return $this->render('home', [
                'cards' => $cards,
                'query' => $query
            ]);
        }
    }
}
<?php

namespace app\controllers;

use app\models\Card;
use app\core\Request;
use app\core\Response;
use app\core\Controller;
use app\core\middlewares\RoleMiddleware;

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
        if ($request->is_method_get()) {
            $query = $request->getBody()['search'] ?? '';

            if (!empty($query)) {
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

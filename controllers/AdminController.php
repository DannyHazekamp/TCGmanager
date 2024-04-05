<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use app\models\Card;
use app\core\Request;
use app\core\Response;
use app\core\App;

class AdminController extends Controller 
{

    public function dashboard() 
    {

        $users = User::findAll();

        return $this->render('admin.dashboard', [
            'users' => $users
        ]);
    }

    public function createCard(Request $request, Response $response)
    {

        $card = new Card();

        $card->name = '';
        $card->attack = '';
        $card->defense = '';
        $card->rarity = '';
        $card->price = '';
        $card->set_id = '';

        if($request->is_method_post()) {
            $card->loadData($request->getBody());

            
        }

    }
}
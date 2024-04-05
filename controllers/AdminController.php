<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use app\models\Card;
use app\models\Set;
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

    public function createSet(Request $request, Response $response)
    {
        $set = new Set();

        $set->name = '';

        if($request->is_method_post()) {
            $set->loadData($request->getBody());
            if($set->validate() && $set->save()) {
                $response->redirect('/dashboard');
            }

            return $this->render('admin.set_create', [
                'model' => $set
            ]);
        }

        return $this->render('admin.set_create', [
            'model' => $set
        ]);
    }


    public function createCard(Request $request, Response $response)
    {

        $card = new Card();

        $card->name = '';
        $card->attack = 0;
        $card->defense = 0;
        $card->rarity = '';
        $card->price = 0.0;
        $card->set_id = 0;

        if($request->is_method_post()) {
            $card->loadData($request->getBody());

            if($card->validate() && $card->save()){
                $response->redirect('/dashboard');
            }
            return $this->render('admin.card_create', [
                'model' => $card
            ]);
        }

        return $this->render('admin.card_create', [
            'model' => $card
        ]);

    }
}
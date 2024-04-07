<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\Deck;

class DeckController extends Controller
{

    public function create(Request $request, Response $response)
    {
        if (App::isNotAuthenticated()) {
            $response->redirect('/');
            return;
        }


        $deck = new Deck();

        $deck->name = '';
        $deck->description = '';
        $deck->user_id = App::$app->user->user_id;

        if($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if($deck->validate() && $deck->save()) {
                $response->redirect('/dashboard');
                return;
            }

            return $this->render('deck.create', [
                'model' => $deck
            ]);
        }

        return $this->render('deck.create', [
            'model' => $deck
        ]);
    }
}
<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\Deck;
use app\models\Card;
use app\models\CardDeck;

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

    public function addCard(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);
        $cardsInDeck = count($deck->cards());

        $cards = Card::findAll();
        $cardDeck = new CardDeck();

        $cardDeck->card_id = 0;
        $cardDeck->deck_id = $deck_id;

        if($request->is_method_post()) {
            $cardDeck->loadData($request->getBody());
            $cardDupes = $deck->countCards($cardDeck->card_id);

            if($cardDupes >= 2 || $cardsInDeck >= 30) {
                $response->redirect("/decks/{$deck_id}");
                return;
            } else {
                if($cardDeck->validate() && $cardDeck->save()) {
                    $response->redirect("/decks/{$deck_id}");
                    return;
                }
            }

            return $this->render('deck.add_card', [
                'model' => $cardDeck,
                'cards' => $cards,
                'deck' => $deck
            ]);
        }

        return $this->render('deck.add_card', [
            'model' => $cardDeck,
            'cards' => $cards,
            'deck' => $deck
        ]);
    }

    public function removeCard(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $deck_id = (int)$params['id'];

        if($request->is_method_post()) {
            $card_id = $request->getBody()['card_id'];

            $cardDeck = CardDeck::findOne(['deck_id' => $deck_id, 'card_id' => $card_id]);

            if($cardDeck->delete()) {
                $response->redirect("/decks/{$deck_id}");
                return;
            }
        }

    }
}
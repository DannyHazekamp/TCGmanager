<?php

namespace app\controllers;

use app\core\App;
use app\models\Card;
use app\models\Deck;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\core\Controller;
use app\models\CardDeck;
use app\core\middlewares\RoleMiddleware;

class DeckController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['premium_user', 'admin']));
    }

    public function create(Request $request, Response $response, Session $session)
    {
        $deck = new Deck();

        $deck->name = '';
        $deck->description = '';
        $deck->user_id = App::$app->user->user_id;

        if ($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if ($deck->validate() && $deck->save()) {
                $session->setMessage('success', 'Deck created successfully');
                $response->redirect('/profile');
                return;
            }

            return $this->render('deck.create', [
                'deck' => $deck
            ]);
        }

        return $this->render('deck.create', [
            'deck' => $deck
        ]);
    }

    public function showDeck(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);
        $cardsInDeck = count($deck->cards());

        $cards = Card::findAll();
        $cardDeck = new CardDeck();

        $cardDeck->card_id = 0;
        $cardDeck->deck_id = $deck_id;

        if ($request->is_method_post()) {
            $cardDeck->loadData($request->getBody());
            $cardDupes = $deck->countCards($cardDeck->card_id);

            if ($cardDupes >= 2 || $cardsInDeck >= 30) {
                $session->setMessage('danger', 'Limit reached (2 copies per card/30 cards per deck)');
                $response->redirect("/decks/{$deck_id}");
                return;
            } else {
                if ($cardDeck->validate() && $cardDeck->save()) {
                    $response->redirect("/decks/{$deck_id}");
                    return;
                }
            }

            return $this->render('deck.show', [
                'cardDeck' => $cardDeck,
                'cards' => $cards,
                'deck' => $deck
            ]);
        }

        return $this->render('deck.show', [
            'cardDeck' => $cardDeck,
            'cards' => $cards,
            'deck' => $deck
        ]);
    }

    public function removeCardDeck(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $deck_id = (int)$params['id'];

        if ($request->is_method_post()) {
            $card_id = $request->getBody()['card_id'];

            $cardDeck = CardDeck::findOne(['deck_id' => $deck_id, 'card_id' => $card_id]);

            if ($cardDeck->delete()) {
                $response->redirect("/decks/{$deck_id}");
                return;
            }
        }
    }

    public function editDeck(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if ($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if ($deck->validate() && $deck->update()) {
                $session->setMessage('success', 'Deck edited successfully');
                $response->redirect("/decks/{$deck_id}");
                return;
            }

            return $this->render('deck.edit', [
                'deck' => $deck
            ]);
        }

        return $this->render('deck.edit', [
            'deck' => $deck
        ]);
    }

    public function deleteDeck(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if ($request->is_method_post() && $deck) {
            if ($deck->deleteRelated()) {
                $session->setMessage('danger', 'Deck deleted successfully');
                $response->redirect('/profile');
                return;
            }
        }
    }
}

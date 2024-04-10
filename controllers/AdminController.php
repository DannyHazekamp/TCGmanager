<?php

namespace app\controllers;

use app\core\App;
use app\models\Set;
use app\models\Card;
use app\models\Deck;
use app\models\Role;
use app\models\User;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\core\Controller;
use app\models\CardDeck;
use app\core\middlewares\RoleMiddleware;



class AdminController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['admin']));
    }

    public function dashboard()
    {
        $currentUser = App::$app->user;
        $users = User::findAll();
        $cards = Card::findAll();
        $decks = Deck::findAll();
        $sets = Set::findAll();

        return $this->render('admin.dashboard', [
            'currentUser' => $currentUser,
            'users' => $users,
            'cards' => $cards,
            'decks' => $decks,
            'sets' => $sets
        ]);
    }

    public function showSet(Request $request)
    {
        $params = $request->getRouteParams();
        $set_id = $params['id'];

        $set = Set::findOne(['set_id' => $set_id]);

        return $this->render('admin.set.show', [
            'set' => $set
        ]);
    }

    public function createSet(Request $request, Response $response, Session $session)
    {
        $set = new Set();

        $set->name = '';

        if ($request->is_method_post()) {
            $set->loadData($request->getBody());
            if ($set->validate() && $set->save()) {
                $session->setMessage('success', 'Set created successfully');
                $response->redirect('/dashboard');
                return;
            }

            return $this->render('admin.set.create', [
                'model' => $set
            ]);
        }

        return $this->render('admin.set.create', [
            'model' => $set
        ]);
    }

    public function updateSet(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $set_id = $params['id'];

        $set = Set::findOne(['set_id' => $set_id]);

        if ($request->is_method_post()) {
            $set->loadData($request->getBody());
            if ($set->validate() && $set->update()) {
                $session->setMessage('success', 'Set updated successfully');
                $response->redirect('/dashboard');
                return;
            }

            return $this->render('admin.set.edit', [
                'set' => $set
            ]);
        }

        return $this->render('admin.set.edit', [
            'set' => $set
        ]);
    }

    public function deleteSet(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $set_id = $params['id'];

        $set = Set::findOne(['set_id' => $set_id]);

        if ($request->is_method_post() && $set) {
            $cards = Card::findAll(['set_id' => $set_id]);

            foreach ($cards as $card) {
                $card->set_id = null;
                $card->update();
            }

            if ($set->delete()) {
                $session->setMessage('danger', 'Set deleted');
                $response->redirect('/dashboard');
                return;
            }
        }
    }


    public function showCard(Request $request)
    {
        $params = $request->getRouteParams();
        $card_id = $params['id'];

        $card = Card::findOne(['card_id' => $card_id]);

        return $this->render('admin.card.show', [
            'card' => $card
        ]);
    }

    public function createCard(Request $request, Response $response, Session $session)
    {

        $sets = Set::findAll();

        $card = new Card();
        $card->name = '';
        $card->attack = 0;
        $card->defense = 0;
        $card->rarity = '';
        $card->price = 0.0;
        $card->set_id = 0;

        if ($request->is_method_post()) {
            $card->loadData($request->getBody());

            $image = $request->getFile('image');
            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = App::$ROOT_DIRECTORY . '/public/img/' . $image['name'];
                move_uploaded_file($image['tmp_name'], $imagePath);
                $card->image = '/img/' . $image['name'];
            } else {
                $card->image = '/img/placeholder.png';
            }

            if ($card->validate() && $card->save()) {
                $session->setMessage('success', 'Card created successfully');
                $response->redirect('/dashboard');
                return;
            }
            return $this->render('admin.card.create', [
                'model' => $card,
                'sets' => $sets
            ]);
        }

        return $this->render('admin.card.create', [
            'model' => $card,
            'sets' => $sets
        ]);
    }

    public function updateCard(Request $request, Response $response, Session $session)
    {

        $params = $request->getRouteParams();
        $card_id = $params['id'];

        $sets = Set::findAll();
        $card = Card::findOne(['card_id' => $card_id]);

        if ($request->is_method_post()) {
            $card->loadData($request->getBody());

            $image = $request->getFile('image');
            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = App::$ROOT_DIRECTORY . '/public/img/' . $image['name'];
                move_uploaded_file($image['tmp_name'], $imagePath);
                $card->image = '/img/' . $image['name'];
            } else {
                $card->image = '/img/placeholder.png';
            }

            if ($card->validate() && $card->update()) {
                $session->setMessage('success', 'Card updated successfully');
                $response->redirect('/dashboard');
                return;
            }
            return $this->render('admin.card.edit', [
                'card' => $card,
                'sets' => $sets
            ]);
        }

        return $this->render('admin.card.edit', [
            'card' => $card,
            'sets' => $sets
        ]);
    }

    public function deleteCard(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $card_id = $params['id'];

        $card = Card::findOne(['card_id' => $card_id]);


        foreach ($card->decks() as $cardDeck) {
            $cardDeck->delete();
        }

        $sameImage = Card::findAll(['image' => $card->image]);

        if ($card->image !== '/img/placeholder.png') {
            if (count($sameImage) === 1) {
                $imagePath = App::$ROOT_DIRECTORY . '/public' . $card->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        if ($card->delete()) {
            $session->setMessage('danger', 'Card deleted');
            $response->redirect('/dashboard');
            return;
        }
    }


    public function createDeck(Request $request, Response $response, Session $session)
    {

        $users = User::findAll();

        $deck = new Deck();
        $deck->name = '';
        $deck->description = '';
        $deck->user_id = 0;

        if ($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if ($deck->validate() && $deck->save()) {
                $session->setMessage('success', 'Deck created successfully');
                $response->redirect('/dashboard');
                return;
            }

            return $this->render('admin.deck.create', [
                'users' => $users,
                'deck' => $deck
            ]);
        }

        return $this->render('admin.deck.create', [
            'users' => $users,
            'deck' => $deck
        ]);
    }

    public function createDeckProfile(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $deck = new Deck();

        $deck->name = '';
        $deck->description = '';
        $deck->user_id = $user_id;

        if ($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if ($deck->validate() && $deck->save()) {
                $session->setMessage('success', 'Deck created');
                $response->redirect("/dashboard/profile/{$user_id}");
                return;
            }

            return $this->render('admin.deck.createTwo', [
                'deck' => $deck
            ]);
        }

        return $this->render('admin.deck.createTwo', [
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
                $response->redirect("/dashboard/decks/{$deck_id}");
                return;
            } else {
                if ($cardDeck->validate() && $cardDeck->save()) {
                    $response->redirect("/dashboard/decks/{$deck_id}");
                    return;
                }
            }

            return $this->render('admin.deck.show', [
                'model' => $cardDeck,
                'cards' => $cards,
                'deck' => $deck
            ]);
        }

        return $this->render('admin.deck.show', [
            'model' => $cardDeck,
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
                $response->redirect("/dashboard/decks/{$deck_id}");
                return;
            }
        }
    }

    public function editDeck(Request $request, Response $response, Session $session)
    {
        if (App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if ($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if ($deck->validate() && $deck->update()) {
                $session->setMessage('success', 'Deck successfully updated');
                $response->redirect("/dashboard/decks/{$deck_id}");
                return;
            }

            return $this->render('admin.deck.edit', [
                'deck' => $deck
            ]);
        }

        return $this->render('admin.deck.edit', [
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
                $session->setMessage('danger', 'Deck deleted');

                $currentUrl = $request->getPath();
                $response->redirect("/dashboard");
                return;
            }
        }
    }

    public function deleteDeckProfile(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if ($request->is_method_post() && $deck) {
            $user_id = (int) $deck->user_id;
            if ($deck->deleteRelated()) {
                $session->setMessage('danger', 'Deck deleted');
                $response->redirect("/dashboard/profile/{$user_id}");
                return;
            }
        }
    }

    public function createUser(Request $request, Response $response, Session $session)
    {
        $user = new User();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        $user->role_id = 0;

        $roles = Role::findAll();

        if ($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                $session->setMessage('success', 'User created successfully');
                $response->redirect('/dashboard');
                return;
            }
            return $this->render('admin.user.create', [
                'user' => $user,
                'roles' => $roles
            ]);
        }
        return $this->render('admin.user.create', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function showUser(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $user = User::findOne(['user_id' => $user_id]);

        return $this->render('admin.user.show', [
            'user' => $user
        ]);
    }

    public function updateUser(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $user = User::findOne(['user_id' => $user_id]);
        $roles = Role::findAll();

        if ($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->update()) {
                $session->setMessage('success', 'User has been updated');
                $response->redirect("/dashboard/profile/{$user->user_id}");
                return;
            }

            return $this->render('admin.user.edit', [
                'user' => $user,
                'roles' => $roles
            ]);
        }

        return $this->render('admin.user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function deleteUser(Request $request, Response $response, Session $session)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $user = User::findOne(['user_id' => $user_id]);

        if ($user && $user->user_id === App::$app->user->user_id) {
            $session->setMessage('danger', 'You cannot delete yourself');
            $response->redirect('/dashboard');
            return;
        }

        if ($request->is_method_post() && $user) {

            foreach ($user->decks() as $deck) {

                $deck->deleteRelated();
            }

            if ($user->delete()) {
                $session->setMessage('danger', 'User deleted');
                $response->redirect('/dashboard');
                return;
            }
        }
    }
}

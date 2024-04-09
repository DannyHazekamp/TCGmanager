<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use app\models\Card;
use app\models\Set;
use app\models\Role;
use app\models\Deck;
use app\models\CardDeck;
use app\core\Request;
use app\core\Response;
use app\core\App;
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

    public function createSet(Request $request, Response $response)
    {
        $set = new Set();

        $set->name = '';

        if($request->is_method_post()) {
            $set->loadData($request->getBody());
            if($set->validate() && $set->save()) {
                $response->redirect('/dashboard');
                return;
            }

            return $this->render('admin.set.set_create', [
                'model' => $set
            ]);
        }

        return $this->render('admin.set.set_create', [
            'model' => $set
        ]);
    }

    public function updateSet(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $set_id = $params['id'];

        $set = Set::findOne(['set_id' => $set_id]);

        if($request->is_method_post()) {
            $set->loadData($request->getBody());
            if($set->validate() && $set->update()) {
                $response->redirect('/dashboard');
                return;
            }

            return $this->render('admin.set.set_edit', [
                'set' => $set
            ]);
        }

        return $this->render('admin.set.set_edit', [
            'set' => $set
        ]);
    }

    public function deleteSet(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $set_id = $params['id'];
        
        $set = Set::findOne(['set_id' => $set_id]);
      
        if($request->is_method_post() && $set) {
            $cards = Card::findAll(['set_id' => $set_id]);

            foreach ($cards as $card) {
                $card->set_id = null;
                $card->update();
            }

            if($set->delete()) {
                $response->redirect('/dashboard');
            }
        }
    }   



    public function createCard(Request $request, Response $response)
    {

        $sets = Set::findAll();
        $card = new Card();

        $card->name = '';
        $card->attack = 0;
        $card->defense = 0;
        $card->rarity = '';
        $card->price = 0.0;
        $card->set_id = 0;

        if($request->is_method_post()) {
            $card->loadData($request->getBody());

            $image = $request->getFile('image');
            if($image && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = App::$ROOT_DIRECTORY . '/public/img/' . $image['name'];
                move_uploaded_file($image['tmp_name'], $imagePath);
                $card->image = '/img/' . $image['name'];
            } else {
                $card->image = '/img/placeholder.png';
            }

            if($card->validate() && $card->save()){
                $response->redirect('/dashboard');
            }
            return $this->render('admin.card.card_create', [
                'model' => $card,
                'sets' => $sets
            ]);
        }

        return $this->render('admin.card.card_create', [
            'model' => $card,
            'sets' => $sets
        ]);

    }

    public function updateCard(Request $request, Response $response)
    {
        
        $params = $request->getRouteParams();
        $card_id = $params['id'];

        $sets = Set::findAll();
        $card = Card::findOne(['card_id' => $card_id]);

        if($request->is_method_post()) {
            $card->loadData($request->getBody());

            $image = $request->getFile('image');
            if($image && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = App::$ROOT_DIRECTORY . '/public/img/' . $image['name'];
                move_uploaded_file($image['tmp_name'], $imagePath);
                $card->image = '/img/' . $image['name'];
            } else {
                $card->image = '/img/placeholder.png';
            }

            if($card->validate() && $card->update()){
                $response->redirect('/dashboard');
            }
            return $this->render('admin.card.card_edit', [
                'card' => $card,
                'sets' => $sets
            ]);
        }

        return $this->render('admin.card.card_edit', [
            'card' => $card,
            'sets' => $sets
        ]);

    }


    public function createDeck(Request $request, Response $response)
    {
        if (App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $users = User::findAll();
        $deck = new Deck();

        $deck->name = '';
        $deck->description = '';
        $deck->user_id = 0;

        if($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if($deck->validate() && $deck->save()) {
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

    public function createDeckProfile(Request $request, Response $response)
    {
        if (App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $deck = new Deck();

        $deck->name = '';
        $deck->description = '';
        $deck->user_id = $user_id;

        if($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if($deck->validate() && $deck->save()) {
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

    public function showDeck(Request $request, Response $response)
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
                $response->redirect("/dashboard/decks/{$deck_id}");
                return;
            } else {
                if($cardDeck->validate() && $cardDeck->save()) {
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

        if($request->is_method_post()) {
            $card_id = $request->getBody()['card_id'];

            $cardDeck = CardDeck::findOne(['deck_id' => $deck_id, 'card_id' => $card_id]);

            if($cardDeck->delete()) {
                $response->redirect("/dashboard/decks/{$deck_id}");
                return;
            }
        }

    }

    public function editDeck(Request $request, Response $response)
    {
        if (App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if($request->is_method_post()) {
            $deck->loadData($request->getBody());
            if($deck->validate() && $deck->update()) {
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

    public function deleteDeck(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if($request->is_method_post() && $deck) {
            if($deck->deleteRelated()) {
                $response->redirect('/dashboard');
            }
        }
    }

    public function deleteDeckProfile(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $deck_id = $params['id'];

        $deck = Deck::findOne(['deck_id' => $deck_id]);

        if($request->is_method_post() && $deck) {
            $user_id = (int) $deck->user_id;
            if($deck->deleteRelated()) {
                $response->redirect("/dashboard/profile/{$user_id}");
            }
        }
    }

    public function createUser(Request $request, Response $response)
    {
        $user = new User();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        $user->role_id = 0;
        
        $roles = Role::findAll();

        if($request->is_method_post()){
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->save()){
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

    public function updateUser(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $user = User::findOne(['user_id' => $user_id]);
        $roles = Role::findAll();

        if($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->update()) {
                $response->redirect("/dashboard/profile/{$user->user_id}");
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

    public function deleteUser(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];
        
        $user = User::findOne(['user_id' => $user_id]);
      
        if($user && $user->user_id === App::$app->user->user_id) {
            $response->redirect('/dashboard');
            return;
        }

        if($request->is_method_post() && $user) {

            foreach ($user->decks() as $deck) {
            
                $deck->deleteRelated();
            }

            if($user->delete()) {
                $response->redirect('/dashboard');
                return;
            }
        }
    } 
}
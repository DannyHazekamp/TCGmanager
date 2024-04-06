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
        $cards = Card::findAll();
        return $this->render('admin.dashboard', [
            'users' => $users,
            'cards' => $cards
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
            return $this->render('admin.card_create', [
                'model' => $card,
                'sets' => $sets
            ]);
        }

        return $this->render('admin.card_create', [
            'model' => $card,
            'sets' => $sets
        ]);

    }

    public function updateUser(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $user_id = $params['id'];

        $user = User::findOne(['user_id' => $user_id]);
        $oldEmail = $user->email;
        
        if($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($oldEmail !== $user->email) {
                if ($user->validate()) {
                    if ($user->update()) {
                        $response->redirect('/dashboard');
                    }
                }
            } else {
                if ($user->update()) {
                    $response->redirect('/dashboard');
                }
            }
        }

        return $this->render('admin.user_edit', [
            'user' => $user
        ]);
    }
}
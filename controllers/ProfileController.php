<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\Deck;

class ProfileController extends Controller
{
    public function show(Request $request, Response $response) 
    {
        if (App::isNotAuthenticated()) {
            $response->redirect('/');
            return;
        }

        $user = App::$app->user;
        return $this->render('profile.show', [
            'user' => $user
        ]);
    }


    public function edit(Request $request, Response $response) 
    {
        if (App::isNotAuthenticated()) {
            $response->redirect('/');
            return;
        }

        $user = App::$app->user;

        if($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->update()) {
                $response->redirect('/profile', [
                    'user' => $user
                ]);
            }

            return $this->render('profile.edit', [
                'user' => $user
            ]);

        }

        return $this->render('profile.edit', [
            'user' => $user
        ]);
        
    }
}
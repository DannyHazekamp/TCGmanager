<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\core\middlewares\RoleMiddleware;
use app\models\User;
use app\models\Deck;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['user', 'premium_user', 'admin']));
    }

    public function show(Request $request, Response $response) 
    {
        if (App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $user = App::$app->user;

        return $this->render('profile.show', [
            'user' => $user
        ]);
    }


    public function edit(Request $request, Response $response, Session $session) 
    {
        if (App::isGuest()) {
            $response->redirect('/');
            return;
        }

        $user = App::$app->user;
        
        if($request->is_method_post()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->update()) {
                $session->setMessage('success', 'Profile updated successfully');
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

    public function subscribe(Request $request, Response $response, Session $session)
    {
        $user = App::$app->user;

        if($request->is_method_post()) {
            if($user->role_id !== 2) {
                $response->redirect('/profile', [
                    'user' => $user
                ]);
                return;
            }

            $user->loadData($request->getBody());
            $user->role_id = 3;

            if ($user->validate() && $user->update()) {
                $session->setMessage('success', 'Subscribed to premium');
                $response->redirect('/profile', [
                    'user' => $user
                ]);
                return;

            }

        }
    }

    public function unsubscribe(Request $request, Response $response, Session $session)
    {
        $user = App::$app->user;

        if($request->is_method_post()) {
            if($user->role_id !== 3) {
                $response->redirect('/profile', [
                    'user' => $user
                ]);
                return;
            }

            $user->loadData($request->getBody());
            $user->role_id = 2;

            if ($user->validate() && $user->update()) {
                $session->setMessage('danger', 'Unsubscribed from premium');
                $response->redirect('/profile', [
                    'user' => $user
                ]);
                return;
                
            }

        }
    }
}
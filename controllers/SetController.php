<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\core\middlewares\RoleMiddleware;
use app\models\Set;

class SetController extends Controller
{
    // registers the middleware for all roles
    public function __construct()
    {
        $this->registerMiddleware(new RoleMiddleware(['user', 'premium_user', 'admin']));
    }

    // set show
    public function show(Request $request)
    {
        $params = $request->getRouteParams();
        $set_id = $params['id'];

        $set = Set::findOne(['set_id' => $set_id]);

        return $this->render('set.show', [
            'set' => $set
        ]);
    }
}

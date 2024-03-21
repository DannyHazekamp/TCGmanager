<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Request;

class ContactController extends Controller {


    public function viewContact()
    {
        return $this->render('contact');
    }


    public function handleContact(Request $request) 
    {
        $body = $request->getBody();
        return "Handling submit data";
    }
}
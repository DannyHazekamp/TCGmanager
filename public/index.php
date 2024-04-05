<?php 

require_once '../vendor/autoload.php';

use app\core\App;
use app\controllers\HomeController;
use app\controllers\AuthController;
use app\controllers\AdminController;

$app = new App(dirname(__DIR__));

// home
$app->router->get('/', [HomeController::class, 'home']);

// register
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

// login
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

// logout
$app->router->get('/logout', [AuthController::class, 'logout']);

// admin
$app->router->get('/dashboard', [AdminController::class, 'dashboard']);

$app->run();
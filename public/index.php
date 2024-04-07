<?php 

require_once '../vendor/autoload.php';

use app\core\App;
use app\controllers\HomeController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\CardController;
use app\controllers\DeckController;
use app\controllers\ProfileController;

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

// admin dashboard
$app->router->get('/dashboard', [AdminController::class, 'dashboard']);

// admin set crud
$app->router->get('/dashboard/sets', [AdminController::class, 'createSet']);
$app->router->post('/dashboard/sets', [AdminController::class, 'createSet']);

// admin card crud
$app->router->get('/dashboard/cards', [AdminController::class, 'createCard']);
$app->router->post('/dashboard/cards', [AdminController::class, 'createCard']);

// admin user management
$app->router->get('/dashboard/users/{id}', [AdminController::class, 'updateUser']);
$app->router->post('/dashboard/users/{id}', [AdminController::class, 'updateUser']);

// cards
$app->router->get('/cards/{id}', [CardController::class, 'show']);

// decks
$app->router->get('/decks', [DeckController::class, 'create']);
$app->router->post('/decks', [DeckController::class, 'create']);
$app->router->get('/decks/{id}', [DeckController::class,'addCard']);
$app->router->post('/decks/{id}', [DeckController::class,'addCard']);

// profile
$app->router->get('/profile', [ProfileController::class, 'show']);

$app->run();
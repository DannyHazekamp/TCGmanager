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
$app->router->get('/dashboard/sets/{id}', [AdminController::class, 'updateSet']);
$app->router->post('/dashboard/sets/{id}/delete', [AdminController::class, 'deleteSet']);
$app->router->post('/dashboard/sets/{id}', [AdminController::class, 'updateSet']);

// admin deck management
$app->router->get('/dashboard/decks', [AdminController::class, 'createDeck']);
$app->router->post('/dashboard/decks', [AdminController::class, 'createDeck']);
$app->router->get('/dashboard/decks/profile/{id}', [AdminController::class, 'createDeckProfile']);
$app->router->post('/dashboard/decks/profile/{id}', [AdminController::class, 'createDeckProfile']);
$app->router->get('/dashboard/decks/edit/{id}', [AdminController::class, 'editDeck']);
$app->router->post('/dashboard/decks/edit/{id}', [AdminController::class, 'editDeck']);
$app->router->get('/dashboard/decks/{id}', [AdminController::class,'showDeck']);
$app->router->post('/dashboard/decks/{id}/add', [AdminController::class,'showDeck']);
$app->router->post('/dashboard/decks/{id}/remove', [AdminController::class, 'removeCardDeck']);
$app->router->post('/dashboard/decks/{id}/delete', [AdminController::class, 'deleteDeck']);
$app->router->post('/dashboard/decks/delete/profile/{id}', [AdminController::class, 'deleteDeckProfile']);




// admin card management
$app->router->get('/dashboard/cards', [AdminController::class, 'createCard']);
$app->router->post('/dashboard/cards', [AdminController::class, 'createCard']);
$app->router->get('/dashboard/cards/{id}', [AdminController::class, 'updateCard']);
$app->router->post('/dashboard/cards/{id}', [AdminController::class, 'updateCard']);


// admin user management
$app->router->get('/dashboard/profile/edit/{id}', [AdminController::class, 'updateUser']);
$app->router->post('/dashboard/profile/edit/{id}', [AdminController::class, 'updateUser']);
$app->router->get('/dashboard/profile/{id}', [AdminController::class, 'showUser']);

// cards
$app->router->get('/cards/{id}', [CardController::class, 'show']);

// decks
$app->router->get('/decks', [DeckController::class, 'create']);
$app->router->post('/decks', [DeckController::class, 'create']);
$app->router->get('/decks/edit/{id}', [DeckController::class, 'editDeck']);
$app->router->post('/decks/edit/{id}', [DeckController::class, 'editDeck']);
$app->router->get('/decks/{id}', [DeckController::class,'showDeck']);
$app->router->post('/decks/{id}/add', [DeckController::class,'showDeck']);
$app->router->post('/decks/{id}/remove', [DeckController::class, 'removeCardDeck']);
$app->router->post('/decks/{id}/delete', [DeckController::class, 'deleteDeck']);

// profile
$app->router->get('/profile', [ProfileController::class, 'show']);
$app->router->get('/profile/edit', [ProfileController::class, 'edit']);
$app->router->post('/profile/edit', [ProfileController::class, 'edit']);

$app->run();
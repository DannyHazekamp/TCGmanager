<?php 

require_once '../vendor/autoload.php';
use app\core\App;
use app\controllers\ContactController;
use app\controllers\HomeController;
use app\controllers\AuthController;

$app = new App(dirname(__DIR__));

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/contact', [ContactController::class, 'viewContact']);
$app->router->post('/contact', [ContactController::class, 'handleContact']);

// register
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

// login
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'handleLogin']);

$app->run();
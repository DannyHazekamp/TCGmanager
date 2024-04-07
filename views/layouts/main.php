<?php 
use app\core\App;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/sets">sets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/cards">cards</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/decks">decks</a>
            </li>
            </ul>

            <?php if (App::isNotAuthenticated()): ?>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
            </ul>

            <?php else: ?>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/logout"><?php echo App::$app->user->username ?>
                  (Logout)
                </a>
            </li>
            </ul>
            <?php endif; ?>

        </div>
    </nav>

    <div class="container-fluid">
      {{content}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
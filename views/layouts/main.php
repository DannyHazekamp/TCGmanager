<?php

use app\core\App;

$user = App::$app->user;
?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="\styles\style.css" rel="stylesheet" type="text/css">
  <title>Tcg manager</title>
</head>

<body class="bg-light bg-gradient">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 mb-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">TCG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if (App::isGuest()) : ?>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>
          </ul>
        <?php else : ?>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link text-white" href="/">Home</a>
            </li>
            <?php if (App::userHasRole(['admin'])) : ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="/dashboard">Dashboard</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="/profile">Profile</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link text-white text-truncate truncate-size" href="/profile"><?php echo App::$app->user->username ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/logout">Logout</a>
            </li>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </nav>


  <div class="container-fluid">

    <?php if (App::$app->session->getMessage('success')) : ?>
      <div class="alert alert-success">
        <?php echo App::$app->session->getMessage('success') ?>
      </div>
    <?php endif; ?>

    <?php if (App::$app->session->getMessage('danger')) : ?>
      <div class="alert alert-danger" role="alert">
        <?php echo App::$app->session->getMessage('danger') ?>
      </div>
    <?php endif; ?>

    {{content}}
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
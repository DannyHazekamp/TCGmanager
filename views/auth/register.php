<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <h1 class="display-5 mb-4">Register</h1>
      <form action="" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" value="<?php echo $user->username ?>" class="form-control <?php echo $user->hasError('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Enter username">
          <div class="invalid-feedback">
            <?php echo $user->getError('username') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" value="<?php echo $user->email ?>" class="form-control <?php echo $user->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Enter email">
          <div class="invalid-feedback">
            <?php echo $user->getError('email') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" value="<?php echo $user->password ?>" class="form-control <?php echo $user->hasError('password') ? 'is-invalid' : '' ?>" id="password" placeholder="Password">
          <div class="invalid-feedback">
            <?php echo $user->getError('password') ?>
          </div>
        </div>
        <div class="row g-1">
          <div class="col-auto d-flex align-items-center">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
          <div class="col-auto d-flex align-items-center">
            <p class="text-secondary mb-0">Already got an account? <a class="text-decoration-none" href="/login">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
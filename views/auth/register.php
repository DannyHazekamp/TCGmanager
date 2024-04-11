<h1>Register</h1>
<form action="" method="post">
  <div class="form-group mb-2">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $model->username ?>" class="form-control <?php echo $model->hasError('username') ? 'is-invalid' : '' ?>" placeholder="Enter username">
    <div class="invalid-feedback">
      <?php echo $model->getError('username') ?>
    </div>
  </div>
  <div class="form-group mb-2">
    <label>Email address</label>
    <input type="email" name="email" value="<?php echo $model->email ?>" class="form-control <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>" placeholder="Enter email">
    <div class="invalid-feedback">
      <?php echo $model->getError('email') ?>
    </div>
  </div>
  <div class="form-group mb-2">
    <label>Password</label>
    <input type="password" name="password" value="<?php echo $model->password ?>" class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Password">
    <div class="invalid-feedback">
      <?php echo $model->getError('password') ?>
    </div>
  </div>
  <div class="row g-1">
    <div class="col-auto d-flex align-items-center">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>
    <div class="col-auto d-flex align-items-center">
      <p class="text-secondary mb-0">Already got a account? <a class="text-decoration-none" href="/login">Login</a></p>
    </div>
  </div>
</form>
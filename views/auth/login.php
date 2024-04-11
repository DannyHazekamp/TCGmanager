<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <h1 class="display-5 mb-4">Login</h1>
      <form action="" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" value="<?php echo $model->email ?>" class="form-control <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Enter email">
          <div class="invalid-feedback">
            <?php echo $model->getError('email') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" value="<?php echo $model->password ?>" class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>" id="password" placeholder="Password">
          <div class="invalid-feedback">
            <?php echo $model->getError('password') ?>
          </div>
        </div>
        <div class="row g-1">
          <div class="col-auto d-flex align-items-center">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
          <div class="col-auto d-flex align-items-center">
            <p class="text-secondary mb-0">No account? <a class="text-decoration-none" href="/register">Register</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
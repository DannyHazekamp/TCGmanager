<h1>Login</h1>
<form action="" method="post">
  <div class="form-group">
    <label>Email address</label>
    <input type="email" name="email" value="<?php echo $model->email ?>" class="form-control <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>" placeholder="Enter email">
    <div class="invalid-feedback">
      <?php echo $model->getError('email') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" value="<?php echo $model->password ?>" class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Password">
    <div class="invalid-feedback">
      <?php echo $model->getError('password') ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
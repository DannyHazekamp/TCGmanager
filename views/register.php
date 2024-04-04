<h1>Register</h1>
<form action="" method="post">
<div class="form-group">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $model->username ?>" class="form-control <?php echo $model->hasError('username') ? 'is-invalid' : '' ?>" placeholder="Enter username">
    <div class="invalid-feedback">
      <?php echo $model->getError('username') ?>
    </div>
  </div>
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
  <input type="hidden" name="role_id" value="2">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
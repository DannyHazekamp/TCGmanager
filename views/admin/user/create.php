<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <h1 class="display-5 mb-4">Create a User</h1>
      <form action="" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" value="<?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') ?>" class="form-control <?php echo $user->hasError('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Enter username">
          <div class="invalid-feedback">
            <?php echo $user->getError('username') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>" class="form-control <?php echo $user->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Enter email">
          <div class="invalid-feedback">
            <?php echo $user->getError('email') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" value="<?php echo htmlspecialchars($user->password, ENT_QUOTES, 'UTF-8') ?>" class="form-control <?php echo $user->hasError('password') ? 'is-invalid' : '' ?>" id="password" placeholder="Password">
          <div class="invalid-feedback">
            <?php echo $user->getError('password') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role_id" class="form-control <?php echo $user->hasError('role_id') ? 'is-invalid' : '' ?>" id="role">
            <?php foreach ($roles as $role) : ?>
              <option value="<?php echo $role->role_id ?>"><?php echo $role->name ?></option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback">
            <?php echo $user->getError('role_id') ?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
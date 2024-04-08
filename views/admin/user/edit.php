<h1>Edit user</h1>
<form action="" method="post">
<div class="form-group">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') ?>" class="form-control <?php echo $user->hasError('username') ? 'is-invalid' : '' ?>" placeholder="Enter username">
    <div class="invalid-feedback">
      <?php echo $user->getError('username') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>" class="form-control <?php echo $user->hasError('email') ? 'is-invalid' : '' ?>" placeholder="Enter email">
      <div class="invalid-feedback">
        <?php echo $user->getError('email') ?>
      </div>
  </div>
  <div class="form-group">
    <label>Role</label>
    <select name="role_id" class="form-control <?php echo $user->hasError('role_id') ? 'is-invalid' : '' ?>">
        <option value="1" <?php echo ($user->role_id == 1) ? 'selected' : ''; ?>>Admin</option>
        <option value="2" <?php echo ($user->role_id == 2) ? 'selected' : ''; ?>>User</option>
        <option value="3" <?php echo ($user->role_id == 3) ? 'selected' : ''; ?>>Premium user</option>
    </select>
    <div class="invalid-feedback">
      <?php echo $user->getError('role_id') ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
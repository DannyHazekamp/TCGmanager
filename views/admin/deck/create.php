<h1>Create a deck</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $deck->name ?>" class="form-control <?php echo $deck->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
        <div class="invalid-feedback">
        <?php echo $deck->getError('name') ?>
        </div>
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="description" value="<?php echo $deck->description ?>" class="form-control" placeholder="Enter description">
    </div>
    <div class="form-group">
    <label>Users</label>
    <select class="form-select" name="user_id" aria-label="Default select example">
      <?php foreach ($users as $user): ?>
          <option value="<?php echo $user->user_id; ?>"><?php echo $user->username; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


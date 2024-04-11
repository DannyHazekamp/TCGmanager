<h1>Create a deck</h1>
<form action="" method="post">
    <div class="form-group mb-2">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $deck->name ?>" class="form-control <?php echo $deck->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
        <div class="invalid-feedback">
          <?php echo $deck->getError('name') ?>
        </div>
    </div>
    <div class="form-group mb-2">
        <label>Description</label>
        <textarea type="text" class="form-control <?php echo $deck->hasError('description') ? 'is-invalid' : '' ?>" name="description" placeholder="Enter description"><?php echo $deck->description ?></textarea>
        <div class="invalid-feedback">
          <?php echo $deck->getError('description') ?>
        </div>
    </div>
    <div class="form-group mb-2">
    <label>Users</label>
    <select class="form-select" name="user_id" aria-label="Default select example">
      <?php foreach ($users as $user): ?>
          <option value="<?php echo $user->user_id; ?>"><?php echo $user->username; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


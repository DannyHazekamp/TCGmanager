<h1>Create a set</h1>
<form action="" method="post">
<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $model->name ?>" class="form-control <?php echo $model->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $model->getError('name') ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
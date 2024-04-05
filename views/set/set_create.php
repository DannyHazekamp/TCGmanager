<h1>Create a set</h1>
<form action="" method="post">
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $model->name ?>" class="form-control <?php echo $model->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $model->getError('name') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Release date</label>
    <input type="text" name="release_date" value="<?php echo $model->release_date ?>" class="form-control <?php echo $model->hasError('release_date') ? 'is-invalid' : '' ?>" placeholder="Enter release date">
    <div class="invalid-feedback">
      <?php echo $model->getError('release_date') ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
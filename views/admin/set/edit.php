<h1>Edit the set</h1>
<form action="" method="post">
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $set->name ?>" class="form-control <?php echo $set->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $set->getError('name') ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
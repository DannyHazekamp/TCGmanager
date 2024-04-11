<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <h1 class="display-5 mb-4">Edit set</h1>
      <form action="" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" value="<?php echo $set->name ?>" class="form-control <?php echo $set->hasError('name') ? 'is-invalid' : '' ?>" id="name" placeholder="Enter name">
          <div class="invalid-feedback">
            <?php echo $set->getError('name') ?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
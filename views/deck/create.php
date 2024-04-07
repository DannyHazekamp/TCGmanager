<h1>Create a deck</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $model->name ?>" class="form-control <?php echo $model->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
        <div class="invalid-feedback">
        <?php echo $model->getError('name') ?>
        </div>
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="description" value="<?php echo $model->description ?>" class="form-control" placeholder="Enter description">
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


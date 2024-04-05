<h1>Create a card</h1>
<form action="" method="post">
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $model->name ?>" class="form-control <?php echo $model->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $model->getError('name') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Attack power</label>
    <input type="text" name="attack" value="<?php echo $model->attack ?>" class="form-control <?php echo $model->hasError('attack') ? 'is-invalid' : '' ?>" placeholder="Enter attack power">
    <div class="invalid-feedback">
      <?php echo $model->getError('attack') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Defense</label>
    <input type="text" name="defense" value="<?php echo $model->defense ?>" class="form-control <?php echo $model->hasError('defense') ? 'is-invalid' : '' ?>" placeholder="Enter defensive power">
    <div class="invalid-feedback">
      <?php echo $model->getError('defense') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Rarity</label>
    <input type="text" name="rarity" value="<?php echo $model->rarity ?>" class="form-control <?php echo $model->hasError('rarity') ? 'is-invalid' : '' ?>" placeholder="Enter the rarity">
    <div class="invalid-feedback">
      <?php echo $model->getError('rarity') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Price</label>
    <input type="text" name="price" value="<?php echo $model->price ?>" class="form-control <?php echo $model->hasError('price') ? 'is-invalid' : '' ?>" placeholder="Enter the price">
    <div class="invalid-feedback">
      <?php echo $model->getError('price') ?>
    </div>
  </div>
  <div class="form-group">
    <select class="form-select" aria-label="Default select example">
        <option selected>Select a set (WIP)</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>
    </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

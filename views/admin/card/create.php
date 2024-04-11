<h1>Create a card</h1>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group mb-2">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $model->name ?>" class="form-control <?php echo $model->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $model->getError('name') ?>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Attack power</label>
        <input type="number" name="attack" value="<?php echo $model->attack ?>" class="form-control <?php echo $model->hasError('attack') ? 'is-invalid' : '' ?>" placeholder="Enter attack power">
        <div class="invalid-feedback">
          <?php echo $model->getError('attack') ?>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Defense</label>
        <input type="number" name="defense" value="<?php echo $model->defense ?>" class="form-control <?php echo $model->hasError('defense') ? 'is-invalid' : '' ?>" placeholder="Enter defensive power">
        <div class="invalid-feedback">
          <?php echo $model->getError('defense') ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label>Rarity</label>
        <select name="rarity" class="form-control <?php echo $model->hasError('rarity') ? 'is-invalid' : '' ?>">
          <option value="Common">Common</option>
          <option value="Rare">Rare</option>
          <option value="Epic">Epic</option>
          <option value="Legendary">Legendary</option>
        </select>
        <div class="invalid-feedback">
          <?php echo $model->getError('rarity') ?>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label>Set</label>
        <select class="form-select" name="set_id" aria-label="Default select example">
          <?php foreach ($sets as $set) : ?>
            <option value="<?php echo $set->set_id; ?>"><?php echo $set->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label>Price</label>
        <div class="input-group mb-3">
          <span class="input-group-text">€</span>
          <input type="number" name="price" value="<?php echo $model->price ?>" class="form-control <?php echo $model->hasError('price') ? 'is-invalid' : '' ?>" placeholder="Enter the price">
          <div class="invalid-feedback">
            <?php echo $model->getError('price') ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group mb-2">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>
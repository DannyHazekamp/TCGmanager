<h1>Edit the card</h1>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $card->name ?>" class="form-control <?php echo $card->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $card->getError('name') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Attack power</label>
    <input type="text" name="attack" value="<?php echo $card->attack ?>" class="form-control <?php echo $card->hasError('attack') ? 'is-invalid' : '' ?>" placeholder="Enter attack power">
    <div class="invalid-feedback">
      <?php echo $card->getError('attack') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Defense</label>
    <input type="text" name="defense" value="<?php echo $card->defense ?>" class="form-control <?php echo $card->hasError('defense') ? 'is-invalid' : '' ?>" placeholder="Enter defensive power">
    <div class="invalid-feedback">
      <?php echo $card->getError('defense') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Rarity</label>
    <input type="text" name="rarity" value="<?php echo $card->rarity ?>" class="form-control <?php echo $card->hasError('rarity') ? 'is-invalid' : '' ?>" placeholder="Enter the rarity">
    <div class="invalid-feedback">
      <?php echo $card->getError('rarity') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Price</label>
    <input type="number" name="price" value="<?php echo $card->price ?>" class="form-control <?php echo $card->hasError('price') ? 'is-invalid' : '' ?>" placeholder="Enter the price">
    <div class="invalid-feedback">
      <?php echo $card->getError('price') ?>
    </div>
  </div>
  <div class="form-group">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <div class="form-group">
    <label>Set</label>
    <select class="form-select" name="set_id" aria-label="Default select example">
      <?php foreach ($sets as $set): ?>
          <option value="<?php echo $set->set_id; ?>"><?php echo $set->name; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

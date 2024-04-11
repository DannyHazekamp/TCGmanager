<h1>Edit the card</h1>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group mb-2">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo $card->name ?>" class="form-control <?php echo $card->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Enter name">
    <div class="invalid-feedback">
      <?php echo $card->getError('name') ?>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Attack power</label>
        <input type="number" name="attack" value="<?php echo $card->attack ?>" class="form-control <?php echo $card->hasError('attack') ? 'is-invalid' : '' ?>" placeholder="Enter attack power">
        <div class="invalid-feedback">
          <?php echo $card->getError('attack') ?>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Defense</label>
        <input type="number" name="defense" value="<?php echo $card->defense ?>" class="form-control <?php echo $card->hasError('defense') ? 'is-invalid' : '' ?>" placeholder="Enter defensive power">
        <div class="invalid-feedback">
          <?php echo $card->getError('defense') ?>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label>Rarity</label>
        <select name="rarity" class="form-control <?php echo $card->hasError('rarity') ? 'is-invalid' : '' ?>">
          <option value="Common" <?php echo ($card->rarity == 'Common') ? 'selected' : '' ?>>Common</option>
          <option value="Rare" <?php echo ($card->rarity == 'Rare') ? 'selected' : '' ?>>Rare</option>
          <option value="Epic" <?php echo ($card->rarity == 'Epic') ? 'selected' : '' ?>>Epic</option>
          <option value="Legendary" <?php echo ($card->rarity == 'Legendary') ? 'selected' : '' ?>>Legendary</option>
        </select>
        <div class="invalid-feedback">
          <?php echo $card->getError('rarity') ?>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group mb-2">
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
          <input type="number" name="price" value="<?php echo $card->price ?>" class="form-control <?php echo $card->hasError('price') ? 'is-invalid' : '' ?>" placeholder="Enter the price">
          <div class="invalid-feedback">
            <?php echo $card->getError('price') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group mb-2">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
</form>
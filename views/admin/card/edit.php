<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <h1 class="display-5 mb-4">Edit card</h1>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" value="<?php echo $card->name ?>" class="form-control <?php echo $card->hasError('name') ? 'is-invalid' : '' ?>" id="name" placeholder="Enter name">
          <div class="invalid-feedback">
            <?php echo $card->getError('name') ?>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-6">
            <label for="attack" class="form-label">Attack power</label>
            <input type="number" min="1" max="1000" name="attack" value="<?php echo $card->attack ?>" class="form-control <?php echo $card->hasError('attack') ? 'is-invalid' : '' ?>" id="attack" placeholder="Enter attack power" required>
            <div class="invalid-feedback">
              <?php echo $card->hasError('attack') ? $card->getError('attack') : 'Please enter attack power'; ?>
            </div>
          </div>
          <div class="col-sm-6">
            <label for="defense" class="form-label">Defense</label>
            <input type="number" min="1" max="1000" name="defense" value="<?php echo $card->defense ?>" class="form-control <?php echo $card->hasError('defense') ? 'is-invalid' : '' ?>" id="defense" placeholder="Enter defensive power" required>
            <div class="invalid-feedback">
              <?php echo $card->hasError('defense') ? $card->getError('defense') : 'Please enter defensive power'; ?>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-4">
            <label for="rarity" class="form-label">Rarity</label>
            <select name="rarity" class="form-control <?php echo $card->hasError('rarity') ? 'is-invalid' : '' ?>" id="rarity">
              <option value="Common" <?php echo ($card->rarity == 'Common') ? 'selected' : '' ?>>Common</option>
              <option value="Rare" <?php echo ($card->rarity == 'Rare') ? 'selected' : '' ?>>Rare</option>
              <option value="Epic" <?php echo ($card->rarity == 'Epic') ? 'selected' : '' ?>>Epic</option>
              <option value="Legendary" <?php echo ($card->rarity == 'Legendary') ? 'selected' : '' ?>>Legendary</option>
            </select>
            <div class="invalid-feedback">
              <?php echo $card->getError('rarity') ?>
            </div>
          </div>
          <div class="col-sm-4">
            <label for="set_id" class="form-label">Set</label>
            <select class="form-select" name="set_id" id="set_id" aria-label="Default select example">
              <?php foreach ($sets as $set) : ?>
                <option value="<?php echo $set->set_id; ?>"><?php echo $set->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-4">
            <label for="price" class="form-label">Price</label>
            <div class="input-group">
              <span class="input-group-text">€</span>
              <input type="number" step=".01" min="0.01" max="100000" name="price" value="<?php echo $card->price ?>" class="form-control <?php echo $card->hasError('price') ? 'is-invalid' : '' ?>" id="price" placeholder="Enter the price" required>
              <div class="invalid-feedback">
                <?php echo $card->getError('price') ?>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" name="image" class="form-control" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
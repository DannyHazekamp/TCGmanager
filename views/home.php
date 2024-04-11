<div class="row row-cols-1">
    <form action="/search" method="get">
        <div class="input-group mb-3">
            <input type="text" value="<?php echo htmlspecialchars('', ENT_QUOTES, 'UTF-8') ?>" class="form-control" name="search" placeholder="Search...">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
    <?php foreach ($cards as $card): ?>
    <div class="col-lg-1 mb-2">
        <a class="nav-link" href="/cards/<?php echo $card->card_id ?>">
        <div class="card h-100">
            <img src="<?php echo $card->image ?>" class="card-img-top" alt="Card Image">
            <div class="card-body text-center overflow-hidden">
                <h5 class="card-title text-truncate"><?php echo $card->name ?></h5>
            </div>
        </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

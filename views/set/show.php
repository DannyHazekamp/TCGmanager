<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center">
            <h1 class="display-5"><?php echo $set->name ?></h1>
            <h4 class="mb-4">Cards in the set:</h4>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 row-cols-xl-8 justify-content-center">
        <?php foreach ($set->cards() as $card) : ?>
            <div class="col mb-4">
                <a class="nav-link" href="/cards/<?php echo $card->card_id ?>">
                    <div class="card h-100">
                        <img src="<?php echo $card->image ?>" class="card-img-top" alt="Card Image">
                        <div class="card-body text-center">
                            <h5 class="card-title text-truncate"><?php echo $card->name ?></h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row row-cols-1 text-center">
    <h1><?php echo $set->name ?></h1>
    <?php foreach ($set->cards() as $card): ?>
    <div class="col-lg-1 mb-2">
        <a class="nav-link" href="/dashboard/cards/<?php echo $card->card_id ?>">
        <div class="card h-100">
            <img src="<?php echo $card->image ?>" class="card-img-top" alt="Card Image">
            <div class="card-body text-center">
                <h5 class="card-title"><?php echo $card->name ?></h5>
            </div>
        </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
<div class="row">
    <div class="col-md-6 text-center">
        <img src="<?php echo $card->image ?>" class="w-50" alt="Card Image">
    </div>
    <div class="col-md-6 text-md-start text-center">
        <div class="card-info">
            <h2><?php echo $card->name ?></h2>
            <p><strong>Attack Power:</strong> <?php echo $card->attack ?></p>
            <p><strong>Defense:</strong> <?php echo $card->defense ?></p>
            <p><strong>Rarity:</strong> <?php echo $card->rarity ?></p>
            <p><strong>Price:</strong> <?php echo $card->price ?></p>
            <strong>Set: </strong>
            <?php if ($card->set()): ?>
                <a class="text-decoration-none" href="/dashboard/sets/<?php echo $card->set()->set_id ?>">
                    <?php echo $card->set()->name ?>
                </a>
            <?php else: ?>
                No set
            <?php endif; ?>
        </div>
    </div>
</div>
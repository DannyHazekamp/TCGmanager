<div class="row">
    <div class="col-md-6 text-center">
        <img src="<?php echo $card->image ?>" class="w-50" alt="<?php echo $card->name ?>">
    </div>
    <div class="col-md-6 text-md-start text-center">
        <div class="card-info overflow-hidden">
            <h2 class="display-5"><?php echo $card->name ?></h2>
            <p><strong>Attack:</strong> <?php echo $card->attack ?></p>
            <p><strong>Defense:</strong> <?php echo $card->defense ?></p>
            <p><strong>Rarity:</strong> <?php echo $card->rarity ?></p>
            <p><strong>Price:</strong> €<?php echo $card->price ?></p>
            <strong>Set: </strong>
            <?php if ($card->set()) : ?>
                <a class="text-decoration-none text-truncate truncate-size" href="/sets/<?php echo $card->set()->set_id ?>">
                    <?php echo $card->set()->name ?>
                </a>
            <?php else : ?>
                No set
            <?php endif; ?>
        </div>
    </div>
</div>
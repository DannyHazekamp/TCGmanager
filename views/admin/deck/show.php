<div class="row">
    <div class="col-12 text-center">
        <h1 class="display-5"><?php echo $deck->name; ?></h1>
        <div class="d-flex justify-content-center mb-2">
            <div class="mx-1">
                <a href="/dashboard/decks/edit/<?php echo $deck->deck_id; ?>" class="btn btn-primary">Edit</a>
            </div>
            <div class="mx-1">
                <form action="/dashboard/decks/delete/profile/<?php echo $deck->deck_id ?>" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><?php echo $deck->description; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6 text-center">
        <h1 class="display-6">Cards in deck <?php echo count($deck->cards()); ?>/30</h1>
        <div class="row row-cols row-cols-md-4 row-cols-lg-6 row-cols-xl-8 g-4">
            <?php foreach ($deck->cards() as $card) : ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $card->card()->image; ?>" class="card-img-top" alt="<?php echo $card->card()->name; ?>">
                        <div class="card-body">
                            <h5 class="card-title text-truncate truncate-size"><?php echo $card->card()->name; ?></h5>
                            <form action="/dashboard/decks/<?php echo $deck->deck_id; ?>/remove" method="post">
                                <input type="hidden" name="card_id" value="<?php echo $card->card_id; ?>">
                                <button type="submit" class="btn text-truncate mw-100  btn-danger"><strong>-</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-6 text-center">
        <h1 class="display-6">Add cards</h1>
        <div class="row row-cols row-cols-md-4 row-cols-lg-6 row-cols-xl-8 g-4">
            <?php foreach ($cards as $card) : ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $card->image; ?>" class="card-img-top" alt="<?php echo $card->name; ?>">
                        <div class="card-body">
                            <h5 class="card-title text-truncate truncate-size"><?php echo $card->name; ?></h5>
                            <form action="/dashboard/decks/<?php echo $deck->deck_id; ?>/add" method="post">
                                <input type="hidden" name="card_id" value="<?php echo $card->card_id; ?>">
                                <button type="submit" class="btn text-truncate mw-100 btn-primary"><strong>+</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
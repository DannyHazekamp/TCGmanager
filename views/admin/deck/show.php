<div class="row">
    <div class="row">
    <div class="col-md-12 text-center">
        <h1><?php echo $deck->name; ?></h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text">  <?php echo $deck->description; ?></p>
                <a href="/dashboard/decks/edit/<?php echo $deck->deck_id; ?>" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6 text-center">
    <h1>Cards in deck <?php echo count($deck->cards()); ?>/30</h1>
    <div class="row row-cols-1 row-cols-md-6 g-4">
            <?php foreach ($deck->cards() as $card): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $card->card()->image; ?>" class="card-img-top" alt="<?php echo $card->card()->name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $card->card()->name; ?></h5>
                            <form action="/dashboard/decks/<?php echo $deck->deck_id; ?>/remove" method="post">
                                <input type="hidden" name="card_id" value="<?php echo $card->card_id; ?>">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-6 text-center">
    <h1>Add cards</h1>
        <div class="row row-cols-1 row-cols-md-6 g-4">
            <?php foreach ($cards as $card): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $card->image; ?>" class="card-img-top" alt="<?php echo $card->name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $card->name; ?></h5>
                            <form action="/dashboard/decks/<?php echo $deck->deck_id; ?>/add" method="post">
                                <input type="hidden" name="card_id" value="<?php echo $card->card_id; ?>">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
</div>
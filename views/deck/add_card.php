<div class="row">
    <div class="col-md-2 text-center">
        <h1>Deck</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <strong>Name:</strong> <?php echo $deck->name; ?></h5>
                <p class="card-text"> <strong>Decription:</strong> <?php echo $deck->description; ?></p>
                <a href="" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
    <div class="col-md-5 text-center">
    <h1>Cards in deck</h1>
    <div class="row row-cols-1 row-cols-md-6 g-4">
            <?php foreach ($deck->cards() as $card): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $card->card()->image; ?>" class="card-img-top" alt="<?php echo $card->card()->name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $card->card()->name; ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-5 text-center">
    <h1>Add cards</h1>
        <div class="row row-cols-1 row-cols-md-6 g-4">
            <?php foreach ($cards as $card): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $card->image; ?>" class="card-img-top" alt="<?php echo $card->name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $card->name; ?></h5>
                            <form action="" method="post">
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
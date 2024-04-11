<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center">
            <h1 class="display-5">Home</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="/search" method="get">
                <div class="input-group mb-3">
                    <input type="text" value="<?php echo htmlspecialchars('', ENT_QUOTES, 'UTF-8') ?>" class="form-control" name="search" placeholder="Search for a card">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
        <?php foreach ($cards as $card) : ?>
            <div class="col mb-4">
                <a class="nav-link" href="/cards/<?php echo $card->card_id ?>">
                    <div class="card">
                        <img src="<?php echo $card->image ?>" class="card-img-top" alt="Card Image">
                        <div class="card-body text-center">
                            <h5 class="card-title text-truncate truncate-size"><?php echo $card->name ?></h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row">
  <div class="col-md-6 text-center">
    <h1 class="display-5">Profile</h1>
    <div class="card">
      <div class="card-body overflow-hidden">
        <h5 class="card-title"> <strong>Username:</strong> <span class="text-truncate truncate-size"><?php echo $user->username; ?></span></h5>
        <p class="card-text"> <strong>E-mail:</strong> <span class="text-truncate truncate-size"><?php echo $user->email; ?></span></p>
        <p class="card-text"> <strong>Role:</strong> <?php echo $user->role()->name; ?></p>
        <a href="/profile/edit" class="btn btn-primary">Edit</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 text-center align-self-center">
    <h1 class="mb-4 display-5">My decks
      <?php if ($user->hasRole('premium_user', 'admin')) : ?> <a href="/decks" class="btn btn-primary">Create</a> <?php endif; ?>
    </h1>

    <?php if ($user->hasRole('premium_user')) : ?>
      <form action="/profile/unsubscribe" method="post">
        <button type="submit" class="btn btn-primary">Unsubscribe</button>
      </form>
    <?php endif; ?>

    <?php if ($user->hasRole(['premium_user', 'admin'])) : ?>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php foreach ($user->decks() as $deck) : ?>
            <tr>
              <td><?php echo $deck->deck_id ?></td>
              <td class="text-truncate truncate-size"><?php echo $deck->name ?></td>
              <td class="text-truncate truncate-size"><?php echo $deck->description ?></td>
              <td><a href="/decks/<?php echo $deck->deck_id; ?>" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="/decks/<?php echo $deck->deck_id ?>/delete" method="post">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <h4>Premium required for the deck function</h4>
      <form action="/profile/subscribe" method="post">
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </form>
    <?php endif; ?>
  </div>
</div>
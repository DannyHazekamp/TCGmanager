<div class="row">
<div class="col-md-6 text-center">
    <h1 class="display-5">Profile</h1>
    <div class="card">
        <div class="card-body overflow-hidden">
            <h5 class="card-title">
                <strong>Username:</strong>
                <span class="text-truncate truncate-size"><?php echo $user->username; ?></span>
            </h5>
            <p class="card-text">
                <strong>E-mail:</strong>
                <span class="text-truncate truncate-size"><?php echo $user->email; ?></span>
            </p>
            <p class="card-text">
                <strong>Role:</strong>
                <?php echo $user->role()->name; ?>
            </p>
            <div class="d-flex justify-content-center">
                <a href="/dashboard/profile/edit/<?php echo $user->user_id ?>" class="btn btn-primary me-2">Edit</a>
                <form action="/dashboard/profile/<?php echo $user->user_id ?>/delete" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

  <div class="col-md-6 text-center align-self-center">
    <h1 class="mb-4 display-5">My decks <a href="/dashboard/decks/profile/<?php echo $user->user_id ?>" class="btn btn-primary">Create</a></h1>

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
            <td><a href="/dashboard/decks/<?php echo $deck->deck_id; ?>" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="/dashboard/decks/delete/profile/<?php echo $deck->deck_id ?>" method="post">
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
    <div class="col-md-6 text-center">
        <h1>Profile</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <strong>Username:</strong> <?php echo $user->username; ?></h5>
                <p class="card-text"> <strong>E-mail:</strong> <?php echo $user->email; ?></p>
                <p class="card-text"> <strong>Role:</strong> <?php echo $user->role()->name; ?></p>
                <a href="/dashboard/profile/edit/<?php echo $user->user_id; ?>" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center">
    <h1>My decks</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($user->decks() as $deck): ?>
          <tr>
            <td><?php echo $deck->deck_id ?></td>
            <td><?php echo $deck->name ?></td>
            <td><?php echo $deck->description ?></td>
            <td><a href="/decks/<?php echo $deck->deck_id; ?>" class="btn btn-primary">Edit</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
</div>
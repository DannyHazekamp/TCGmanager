
<div class="row">
    <div class="col">
        <h1>Admin dashboard</h1>
    </div>
</div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="cards-tab" data-bs-toggle="tab" data-bs-target="#cards" type="button" role="tab" aria-controls="cards" aria-selected="false">Cards</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="decks-tab" data-bs-toggle="tab" data-bs-target="#decks" type="button" role="tab" aria-controls="decks" aria-selected="false">Decks</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="sets-tab" data-bs-toggle="tab" data-bs-target="#sets" type="button" role="tab" aria-controls="sets" aria-selected="false">Sets</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
      <a href="/dashboard/profile" class="btn btn-primary">Create</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">E-mail</th>
            <th scope="col">Role</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <?php if ($user->user_id !== $currentUser->user_id): ?>
              <tr>
                <td><?php echo $user->user_id ?></td>
                <td><?php echo $user->username ?></td>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->role()->name; ?></td>
                <td><a href="/dashboard/profile/<?php echo $user->user_id; ?>" class="btn btn-primary">Profile</a></td>
                <td>
                  <form action="/dashboard/profile/<?php echo $user->user_id ?>/delete" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="cards" role="tabpanel" aria-labelledby="cards-tab">
      <a href="/dashboard/cards" class="btn btn-primary">Create</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Attack power</th>
            <th scope="col">Defensive power</th>
            <th scope="col">Rarity</th>
            <th scope="col">Price</th>
            <th scope="col">Set</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cards as $card): ?>
            <tr>
              <td><?php echo $card->card_id ?></td>
              <td><?php echo $card->name ?></td>
              <td><?php echo $card->attack ?></td>
              <td><?php echo $card->defense ?></td>
              <td><?php echo $card->rarity ?></td>
              <td><?php echo $card->price ?></td>
              <td><?php echo $card->set() ? $card->set()->name : 'No set'; ?></td>
              <td><a href="/dashboard/cards/<?php echo $card->card_id; ?>" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="/dashboard/cards/<?php echo $card->card_id ?>/delete" method="post">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="decks" role="tabpanel" aria-labelledby="decks-tab">
      <a href="/dashboard/decks" class="btn btn-primary">Create</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">User</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($decks as $deck): ?>
            <tr>
              <td><?php echo $deck->deck_id ?></td>
              <td><?php echo $deck->name ?></td>
              <td><?php echo $deck->description ?></td>
              <td><?php echo $deck->user()->username; ?></td>
              <td><a href="/dashboard/decks/<?php echo $deck->deck_id; ?>" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="/dashboard/decks/<?php echo $deck->deck_id ?>/delete" method="post">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="sets" role="tabpanel" aria-labelledby="sets-tab">
      <a href="/dashboard/sets" class="btn btn-primary">Create</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($sets as $set): ?>
            <tr>
              <td><?php echo $set->set_id ?></td>
              <td><?php echo $set->name ?></td>
              <td><a href="/dashboard/sets/<?php echo $set->set_id ?>" class="btn btn-primary">Edit</a></td>
              <td>
                <form action="/dashboard/sets/<?php echo $set->set_id ?>/delete" method="post">
                  <input type="hidden" name="set_id" value="<?php echo $set->set_id; ?>">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</div>

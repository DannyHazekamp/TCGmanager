<div class="row">
  <div class="col">
    <h1>Admin dashboard</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>".$user->user_id."</td>";
                echo "<td>".$user->username."</td>";
                echo "<td>".$user->email."</td>";
                echo "<td>".$user->role()->name."</td>";
                echo "</tr>";
            }
        ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
  <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Attack</th>
          <th scope="col">Defense</th>
          <th scope="col">Rarity</th>
          <th scope="col">Price</th>
          <th scope="col">Set</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            foreach ($cards as $card) {
                echo "<tr>";
                echo "<td>".$card->card_id."</td>";
                echo "<td>".$card->name."</td>";
                echo "<td>".$card->attack."</td>";
                echo "<td>".$card->defense."</td>";
                echo "<td>".$card->rarity."</td>";
                echo "<td>".$card->price."</td>";
                echo "<td>".$card->set()->name."</td>";
                echo "</tr>";
            }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php 
  // public string $name;
  // public int $attack;
  // public int $defense;
  // public string $rarity;
  // public float $price;
  // public int $set_id;

?>
<h1>Admin dashboard</h1>
<h3>Welcome admin</h3>

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
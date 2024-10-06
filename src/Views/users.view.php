<?php
require_once(__DIR__ . "/partials/head.php");
?>



<div class="usersContainer my-5">
  <h1 class="my-5">Les utilisateurs du forum :</h1>
  <h2>Les utilisateurs</h2>
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Pseudo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
        if (isset($users)) {
          foreach ($users as $user) {
        ?>
            <th scope="row"><?= $user->getId() ?></th>
            <td><a href="/profile?id=<?= $user->getId() ?>"><?= $user->getPseudo() ?></a></td>
      </tr>
  <?php
          }
        }
  ?>

    </tbody>
  </table>
</div>

<div class="usersContainer my-5">
  <h2>Les admins</h2>
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col tablePseudo">Pseudo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
        if (isset($admins)) {
          foreach ($admins as $admin) {
        ?>
            <th scope="row"><?= $admin->getId() ?></th>
            <td><a href="/profile?id=<?= $admin->getId() ?>"><?= $admin->getPseudo() ?><a></td>
      </tr>
  <?php
          }
        }
  ?>

    </tbody>
  </table>
</div>

<?php
include_once(__DIR__ . "/partials/footer.php");
?>
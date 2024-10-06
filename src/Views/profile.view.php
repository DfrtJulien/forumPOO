<?php
require_once(__DIR__ . "/partials/head.php");
?>
<div class="userProfil">
  <h1 class="userName">Profil de : <?= $user->getPseudo() ?></h1>
  <div class="userInfo">
    <?php
    if ($_SESSION['user']['idRole'] == 2) {
    ?>
      <p>Mail : <?= $user->getMail() ?></p>
    <?php
    }
    ?>
    <p>Date d'inscription: <?= $user->getRegisterDate() ?></p>
  </div>
</div>
<?php
include_once(__DIR__ . "/partials/footer.php");
?>
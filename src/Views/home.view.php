<?php
require_once(__DIR__ . "/partials/head.php");
?>
<div class="homeImg">
  <img src="/public//img/hero-manga.png" alt="">

  <?php
  if (isset($_SESSION['user'])) {
  ?>
    <h1>Bienvenue <?= $_SESSION['user']['pseudo'] ?></h1>

  <?php
  } else {
  ?>
    <h1>Bienvenue à toi !</h1>

  <?php
  }
  include_once(__DIR__ . "/partials/footer.php");
  ?>
</div>
<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\AbstractController;


class ProfileController extends AbstractController
{
  public function index()
  {
    if (isset($_GET['id'])) {
      $newUser = new User(null, null, null, null, null, null, null);
      $userId = $_GET['id'];
      $user = $newUser->getUser($userId);
      require_once(__DIR__ . '/../Views/profile.view.php');
    }
  }
}

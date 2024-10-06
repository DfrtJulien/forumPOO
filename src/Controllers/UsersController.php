<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\AbstractController;


class UsersController extends AbstractController
{
  public function users()
  {
    if ($_SESSION['user']['idRole'] != 2) {
      require_once(__DIR__ . '/ErrorController.php');
    } else {

      $test = new User(5, null, null, null, null, null);
      $admins = $test->getUsersRole(2);
      $users = $test->getUsersRole(1);
      require_once(__DIR__ . '/../Views/users.view.php');
    }
  }
}

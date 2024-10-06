<?php

namespace App\Models;

use PDO;
use Config\DataBase;


class User
{
  protected ?int $id;
  protected ?string $pseudo;
  protected ?string $mail;
  protected ?string $password;
  protected ?string $register_date;
  protected int|string|null $id_role;



  public function __construct(?int $id, ?string $pseudo, ?string $mail, ?string $password, ?string $register_date, int|string|null $id_role)
  {
    $this->id = $id;
    $this->pseudo = $pseudo;
    $this->mail = $mail;
    $this->password = $password;
    $this->register_date = $register_date;
    $this->id_role = $id_role;
  }

  public function save(): bool
  {
    $pdo = DataBase::getConnection();
    $sql = "INSERT INTO user (id,pseudo,mail,password,register_date,id_role) VALUES (?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->pseudo, $this->mail, $this->password, $this->register_date, $this->id_role]);
  }

  public function login($mail)
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT * FROM `user` WHERE `mail` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$mail]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row['id_role'] == 1) {
      return new UserAdmin($row['id'], $row['pseudo'], $row['mail'], $row['password'], $row['register_date'], $row['id_role']);
    } elseif ($row['id_role'] == 2) {
      return new UserUsers($row['id'], $row['pseudo'], $row['mail'], $row['password'], $row['register_date'], $row['id_role']);
    } else {
      return null;
    }
  }

  function getUsersRole($value)
  {
    $pdo = DataBase::getConnection();
    $query = "SELECT `pseudo`, `id` FROM `user` WHERE `id_role` = ?";
    $queryStatement = $pdo->prepare($query);
    $queryStatement->execute([$value]);
    $resultFetch =  $queryStatement->fetchAll(PDO::FETCH_ASSOC);
    $users = [];
    foreach ($resultFetch as $row) {
      $user = new User($row['id'], $row['pseudo'], null, null, null, null);
      $users[] = $user;
    }
    return $users;
  }

  function getUser($id)
  {
    $pdo = DataBase::getConnection();
    $query = "SELECT `user`.`pseudo`, `user`.`mail`, `user`.`register_date`, `role`.`name`
    FROM `user`
    INNER JOIN `role` ON `user`.`id_role` = `role`.`id`
    WHERE `user`.`id` = ?";
    $queryStatement = $pdo->prepare($query);
    $queryStatement->execute([$id]);
    $row = $queryStatement->fetch(PDO::FETCH_ASSOC);
    return new User(null, $row['pseudo'], $row['mail'], null, $row['register_date'], null);
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getPseudo(): ?string
  {
    return $this->pseudo;
  }

  public function getMail(): ?string
  {
    return $this->mail;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function getRegisterDate(): ?string
  {
    return $this->register_date;
  }

  public function getRole(): ?int
  {
    return $this->id_role;
  }

  public function setId($id): static
  {
    $this->id = $id;
    return $this;
  }

  public function setPseudo($pseudo): static
  {
    $this->pseudo = $pseudo;
    return $this;
  }

  public function setMail($mail): static
  {
    $this->mail = $mail;
    return $this;
  }

  public function setPassword($password): static
  {
    $this->password = $password;
    return $this;
  }

  public function setRegisterDate($register_date): static
  {
    $this->register_date = $register_date;
    return $this;
  }

  public function setRole($id_role): static
  {
    $this->id_role = $id_role;
    return $this;
  }
}

<?php

namespace App\Models;
use App\Model;

class User extends Model {

  protected const TABLE = 'users';

  public $full_name = 'unknown';
  public $password;
  public $email;

  public function setUser(array $userData) {
    $this->full_name = $userData['name'];
    $this->email = $userData['email'];
    $this->id = $userData['id'];
  }

  public function createUser(array $data) {
    $data['password'] = password_hash($data['password'] . 'JWT_SECRET', PASSWORD_DEFAULT);
    $this->email = $data['email'];
    $this->password = $data['password'];
    $this->full_name = $data['name'];
    $this->insert();
  }
}
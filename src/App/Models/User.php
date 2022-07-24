<?php

namespace App\Models;
use App\Model;

class User extends Model {

  protected const TABLE = 'users';

  public $full_name = 'unknown';
  public $password;
  public $email;

  public function setUser(array $userData) {
    $this->full_name = strip_tags($userData['name']);
    $this->email = strip_tags($userData['email']);
    $this->id = strip_tags($userData['id']);
  }

  public function createUser(array $data) {
    $data['password'] = password_hash($data['password'] . 'JWT_SECRET', PASSWORD_DEFAULT);
    $this->email = strip_tags($data['email']);
    $this->password = strip_tags($data['password']);
    $this->full_name = strip_tags($data['name']);
    $this->insert();
  }
}
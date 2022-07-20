<?php

namespace Models;

class User {
  public $name = 'unknown';
  public $id = null;

  public function setUser(string $name, $id) {
    $this->name = $name;
    $this->id = $id;
  }
}
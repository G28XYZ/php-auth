<?php

namespace Models;

class Post extends \Model {

  protected const TABLE = 'posts';
  
  public $user_post_id;
  public $author;
  public $content;

  public function createPost($text, $author, $id) {
    $this->content = $text;
    $this->author = $author;
    $this->user_post_id = $id;

    if(strlen($text)) {
      $this->insert();
    }
  }

}
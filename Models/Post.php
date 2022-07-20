<?php

namespace Models;

class Post {
  
  protected $db;

  public function __construct($db)
  { 
    $this->db = $db;
  }

  public function getAllPosts() {
    $sql = 'SELECT * FROM posts';
    return $this->db->query($sql);
  }

  public function createPost($text, $author, $id) {
    var_dump($text);
    if(strlen($text)) {
      $sql = "INSERT
              INTO posts(content,author,user_post_id)
              VALUES(
              '$text',
              '$author',
              '$id'
            );";
      $this->db->execute($sql,[]);
    }
  }

}
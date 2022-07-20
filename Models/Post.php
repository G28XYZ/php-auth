<?php

namespace Models;

class Post extends \Model {

  protected const TABLE = 'posts';
  
  public $user_post_id;
  public $author;
  public $content;

}
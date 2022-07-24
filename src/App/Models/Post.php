<?php

namespace App\Models;
use App\Model;

class Post extends Model {

    protected const TABLE = 'posts';

    private $data = [];

    public $user_post_id;
    public $author;
    public $content;

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        return $this->data[$name];
    }

}

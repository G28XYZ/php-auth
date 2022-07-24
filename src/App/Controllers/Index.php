<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Auth;
use App\Models\User;
use App\Models\Textarea;
use utils\Validation;

class Index extends BaseController
{
    public function __invoke() {
        $this->view->post = new Post;
        $this->view->auth = new Auth;
        $this->view->user = new User;
        $this->view->textarea = new Textarea;
        $this->view->validation = new Validation;
        $this->view->display(__DIR__ . '/../../Templates/main.php');
    }
}

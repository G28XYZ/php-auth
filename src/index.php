<?php

require_once __DIR__ . '/Db.php';

use Models\User;
use Models\Post;
use Models\Auth;

require __DIR__ . '/autoload.php';

$user = new User();
$post = new Post();
$auth = new Auth();

$view = new View();

$view->auth = $auth;
$view->user = $user;
$view->post = $post;

$html = $view->render(__DIR__ . '/Templates/main.php');
echo $html;
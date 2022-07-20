<?php

require_once __DIR__ . '/Db.php';

use Models\User;
use Models\Post;
use Models\Auth;

require __DIR__ . '/autoload.php';


$db = new Db();
$user = new User();
$view = new View();
$post = new Post($db);
$auth = new Auth($db);

$view->auth = $auth;
$view->user = $user;
$view->post = $post;

$html = $view->render(__DIR__ . '/Templates/main.php');
echo $html;
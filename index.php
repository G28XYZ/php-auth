<?php

require_once __DIR__ . '/Db.php';

use Models\User;
use Models\Post;
use Models\View;
use Models\Auth;

require __DIR__ . '/autoload.php';


$db = new Db();
$user = new User();
$view = new View();
$post = new Post($db);
$auth = new Auth($db);

$view->assign('auth', $auth);
$view->assign('user', $user);
$view->assign('post', $post);
$view->assign('db', $db);

$view->display(__DIR__ . '/Templates/main.php');
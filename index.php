<?php

require_once 'inc/classes/user.php';
require_once('lib/smtemplate.php');

$user = new User($pdo);
$list = $user->get_users();

foreach($list as $test) {
    echo $test["user_username"];
}

$tpl = new SMTemplate();
$tpl->render('login');
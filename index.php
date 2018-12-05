<?php
require_once 'inc/classes/user.php';
require_once('lib/smtemplate.php');

ob_start();
session_start();
$tpl = new SMTemplate();
$user = new User($pdo);

$data = array();

if($_SESSION['user_session']) {
    $currentUser = $user->getCurrentUserInfo();
    $data = array('userName' => $currentUser['user_username'],);
}

$tpl->render('index', $data);
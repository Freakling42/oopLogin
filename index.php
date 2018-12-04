<?php
require_once 'inc/classes/user.php';
require_once('lib/smtemplate.php');

ob_start();
session_start();
$tpl = new SMTemplate();
$user = new User($pdo);

// Check if log-in form is submitted
if (isset($_POST['log_in'])) {
    // Retrieve form input
    $user_name = trim($_POST['username']);
    $user_email = trim($_POST['username']);
    $user_password = trim($_POST['password']);

    // Check for empty and invalid inputs
    if (empty($user_name) || empty($user_email)) {
        echo "Please enter a valid username or e-mail address";
    } elseif (empty($user_password)) {
        echo "Please enter a valid username or e-mail address";
    } else {
        // Check if the user may be logged in
        if ($user->login($user_name, $user_email, $user_password)) {
        } else {
            echo "Please enter a valid username or e-mail address";
        }
    }
}

// Check if edit form is submitted
if (isset($_POST['edit_user'])) {
    $user_password = trim($_POST['password']);
    if(empty($user_password)){
        echo "Please enter a valid password";
    } else {
        // Check if the user may be logged in
        if ($user->edit($user_password)) {
            echo "yay you have changed password";
        } else {
            echo "Please enter a valid password";
        }    
    }
} 

// Check if edit form is submitted
if (isset($_POST['log_out'])) {
    $user->log_out();
}

if($_SESSION['user_session']) {
    $tpl->render('userEdit');
} else {
    $tpl->render('login');
}
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
        echo "Indtast venligst gyldigt brugernavn eller e-mail addresse";
    } elseif (empty($user_password)) {
        echo "Indtast venligst gyldigt brugernavn eller e-mail addresse";
    } else {
        // Check if the user may be logged in
        if ($user->login($user_name, $user_email, $user_password)) {
        } else {
            echo "Indtast venligst gyldigt brugernavn eller e-mail addresse";
        }
    }
}

// Check if edit form is submitted
if (isset($_POST['edit_user'])) {
    $user_password = trim($_POST['password']);
    $user_password2 = trim($_POST['password2']);
    if(empty($user_password)){
        echo "Indtast venligst gyldigt kodeord";
    } elseif(empty($user_password2)) {
        echo "Indtast venligst gyldigt kodeord";
    } else {
        if($user_password == $user_password2) {
            // change password
            if ($user->edit($user_password)) {
                echo "Kodeord er ændret";
            } else {
                echo "Indtast venligst gyldigt kodeord";
            }          
        } else {
            echo "Kodeord er ikke ens";
        }   
    }
} 

// Check if edit form is submitted
if (isset($_POST['log_out'])) {
    $user->log_out();
}

if($_SESSION['user_session']) {
    $currentUser = $user->getCurrentUserInfo();
    $data = array('userName' => $currentUser['user_username'],);
    $tpl->render('userEdit', $data);
} else {
    $tpl->render('login');
}
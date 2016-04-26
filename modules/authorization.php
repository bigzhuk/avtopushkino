<?php
require_once("../classes/user.class.php");
session_start();
$user = new User();

if (($_POST['button_click'])=='login'){
    $user->login();
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
        echo "1";
    }
    elseif(isset($_SESSION['error']) && $_SESSION['error'] == true) {
        echo "0";
    }

}

if(($_POST['button_click'])=='logout'){
    $user->logout($user);
}



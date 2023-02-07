<?php
    require_once './admin/includes/core/init.php';
    
    $user = new User();
    if(!$user->isLoggedIn()){
        Redirect::to('./index.php');
        exit();
    } else {
        $user->logout();
        Session::put( 'success', 'You have logged out successfully.'); 
        Redirect::to('./login.php');
        exit();
    }
    
?>

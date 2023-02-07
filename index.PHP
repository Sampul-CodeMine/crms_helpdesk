<?php
    define('PAGE_TITLE', 'User Dashboard');
    define('HEADER', TRUE);
    include_once './local_includes/overall/header.php';
    $user = new User();
    if(!$user->isLoggedIn()){
        Redirect::to('./login.php');
        exit();
    }
    if($user->hasPermissions('admin') || $user->hasPermissions('analyst')){
        Redirect::to('./admin/index.php');
        exit();
    }
    define('ACCESS_NAV', TRUE);
    include_once './local_includes/featured/side_navigator.php';
    define('ACCESS_TOP_NAV', TRUE);
    include_once './local_includes/featured/top_navigator.php';
?>
    <!--Pusher starts here-->
    <div class="pusher">
        <!--Main-content starts here-->
        <div class="main-content">
<?php
    define('PAGE_MENU', TRUE);
    include_once './local_includes/featured/page_menu.php';

    if(Session::exists('success')){
        echo '<div class="ui success floating message"><div class="header">Success!</div>' . Session::flash("success") . '</div>';
    }
    define('MENU', TRUE);
    include_once './local_includes/featured/menu.php';
?>

        </div><!--Main-content starts here-->
    </div> <!--Pusher ends here-->
<?php
    define('FOOTER', TRUE);
    include_once './local_includes/overall/footer.php';
?>

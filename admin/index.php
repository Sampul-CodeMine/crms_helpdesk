<?php
    define('PAGE_TITLE', 'Admin Dashboard');
    define('HEADER', TRUE);
    include_once './admin_local_includes/overall/header.php';
    $user = new User();
    if(!$user->isLoggedIn()){
        Redirect::to('../login.php');
        exit();
    }
    if($user->hasPermissions('support') || $user->hasPermissions('engineer')){
        Redirect::to('../index.php');
        exit();
    }
    define('ACCESS_NAV', TRUE);
    include_once './admin_local_includes/contents/side_navigator.php';
    define('ACCESS_TOP_NAV', TRUE);
    include_once './admin_local_includes/contents/top_navigator.php';
?>
    <!--Pusher starts here-->
    <div class="pusher">
        <!--Main-content starts here-->
        <div class="main-content">

<?php
    define('PAGE_MENU', TRUE);
    include_once './admin_local_includes/contents/page_menu.php';

    if(Session::exists('success')){
        echo '<div class="ui success floating message"><div class="header">Success!</div>' . Session::flash("success") . '</div>';
    }
    define('ATM_DISPLAY', TRUE);
    include_once './admin_local_includes/contents/atm_display.php';
    define('TICKET_DISPLAY', TRUE);
    include_once './admin_local_includes/contents/ticket_display.php';
    define('CHART_DISPLAY', TRUE);
    include_once './admin_local_includes/contents/chart_display.php';
?>

        </div><!--Main-content starts here-->
    </div> <!--Pusher ends here-->

<?php
    define('FOOTER', TRUE);
    include_once './admin_local_includes/overall/footer.php'; ?>

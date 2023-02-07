<?php
    define('PAGE_TITLE', 'Add Account');
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
    include_once './admin_local_includes/contents/page_menu.php'; ?>

            <div class="ui mini breadcrumb">
                <a class="section" href="./index.php">Home</a><i class="right chevron icon divider"></i><a href="./accounts.php" class="section">Back</a><i class="right chevron icon divider"></i><div class="active section"><?php echo PAGE_TITLE; ?></div>
            </div>
            <hr class="divider">
<?php include_once './admin_local_includes/contents/add_account.inc.php'; ?>


        </div><!--Main-content starts here-->
    </div> <!--Pusher ends here-->

<?php
    define('FOOTER', TRUE);
    include_once './admin_local_includes/overall/footer.php'; ?>

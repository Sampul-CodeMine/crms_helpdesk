<?php
    define('PAGE_TITLE', 'Account Type Management');
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
                <a class="section" href="./index.php">Home</a><i class="right chevron icon divider"></i><a href="./admincp.php" class="section">Admin Panel</a><i class="right chevron icon divider"></i><div class="active section"><?php echo PAGE_TITLE; ?></div>
            </div>
            <hr class="divider">
            <div class="ui grid stackable padded">
                <div class="ui six wide computer sixteen wide tablet column">
                    <div class="row">
<?php
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(
                'acct_name'        => array(
                    'required'  => true,
                    'max'       => 50,
                    'min'       => 3,
                    'unique'    => 'tab_account_type'
                )
            ));
            if ( $validation->passed() ) {
                $accountType = new User();
                try {
                    $accountType->create( 'tab_account_type', array(
                        'acct_name'         => escaper(ucfirst(Input::get('acct_name'))),
                        'acct_status'       => 1
                    ));

                    Session::flash( 'success', 'Account Type was successfully registered. <a href="./account_types.php">Continue</a>');
                    if ( Session::exists('success')){
                        echo '<div class="ui success floating message"><div class="header">Success!</div>' . Session::flash("success") . '</div>';
                    }
                    exit();

                } catch ( Exception $err ) {
                    die ( $err->getMessage() );
                }
            } else {
?>
            <div class="ui floating error message">
                <div class="header">Error!</div>
<?php
    foreach ( $validation->errors() as $error ) {
        echo $error . "<br>";
    }
?>
            </div>
<?php
            }
        }
    }
?>
                        <p id="form-header" class="ui header huge">Add Account Type</p>
                        <form class="ui form segment acct_type" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_acct_type" id="add_acct_type">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="field">
                                <label for="acct_name">Account Type Name:</label>
                                <input type="text" id="acct_name" name="acct_name" placeholder="Account Type Name" class="" value="<?php echo escaper ( Input::get('acct_name') ); ?>" />
                            </div>
                            <input type="submit" value="Add Type" name="btnAddType" id="btnAddType" class="ui blue huge button">
                            <hr class="divider">
                            <div class="ui error message"></div>
                        </form>
                    </div>
                </div>
                <div class="ui ten wide computer sixteen wide tablet column">
                    <div class="row">
                        <p id="form-header" class="ui header huge">View All Account Types</p>
                        <div class="segment">
<?php $acct_type = DB::getInstance()->free_run('SELECT * FROM `tab_account_type`;'); ?>
                            <table class="ui celled teal table">
                                <thead>
                                    <tr>
                                        <th>Account Type</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php if ( $acct_type->count() ) {
        foreach ( $acct_type->results() as $count => $actype):
    ?>
                                    <tr>
                                        <td><?php echo escaper($actype->acct_name); ?></td>
                                        <td><?php echo (($actype->acct_status === '1' ))? '<em class="ui green basic label">Active</em>' : '<em class="ui red basic label">Inactive</em>'; ?></td>
                                        <td><a onclick="return confirm('Do you want to edit this Account Type?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$actype->acct_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                        <td><a onclick="return confirm('Do you want to delete this Account Type?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$actype->acct_id; ?>"><i class="ui red trash icon"></i></a></td>
                                    </tr>
    <?php
            endforeach;
        } else {
    ?>
                                    <tr>
                                        <td colspan="3">
                                            <p class="ui orange text meta center aligned">No Account Type.</p>
                                        </td>
                                    </tr>
    <?php
            }
    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="ui text right aligned violet table-footer">Caption: Account Type Management</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="./admincp.php" alt="Back to Admin Panel." class="ui">Admin Panel</a>
            </div>

        </div><!--Main-content starts here-->
    </div> <!--Pusher ends here-->

<?php
    define('FOOTER', TRUE);
    include_once './admin_local_includes/overall/footer.php'; ?>

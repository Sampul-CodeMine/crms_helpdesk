<?php
    define('PAGE_TITLE', 'Vendor Type Management');
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
                <a class="section" href="./index.php">Home</a><i class="right chevron icon divider"></i><a href="./vendors.php" class="section">Back</a><i class="right chevron icon divider"></i><div class="active section"><?php echo PAGE_TITLE; ?></div>
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
                'v_t_name'        => array(
                    'required'  => true,
                    'max'       => 100,
                    'min'       => 5,
                    'unique'    => 'tab_vendor_types'
                ),
                'vendor_type_desc'         => array(
                    'required'  => true
                )
            ));
            if ( $validation->passed() ) {
                $vtype = new User();
                try {
                    $vtype->create( 'tab_vendor_types', array(
                        'v_t_name'      => escaper(ucfirst(Input::get('v_t_name'))),
                        'v_t_desc'      => escaper(ucfirst(Input::get('vendor_type_desc'))),
                        'v_t_status'    => 1
                    ));

                    Session::flash( 'success', 'Vendor Type was successfully registered. <a href="./vendor_type.php">Continue</a>');
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
                        <p id="form-header" class="ui header huge">Add Vendor Type</p>
                        <form class="ui form segment vendorType" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_vendor_type_form" id="add_vendor_type_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="field">
                                <label for="v_t_name">Type of Vendor:</label>
                                <input type="text" id="v_t_name" name="v_t_name" placeholder="Type of Vendor" class="" value="<?php echo escaper ( Input::get('v_t_name') ); ?>" />
                            </div>
                            <div class="field">
                                <label for="vendor_type_desc">Vendor Type Description:</label>
                                <textarea id="vendor_type_desc" name="vendor_type_desc" placeholder="Vendor Type Description" class="addr_textarea"><?php echo escaper ( Input::get('vendor_type_desc') ); ?></textarea>
                            </div>
                            <input type="submit" value="Add Vendor Type" name="btnVendorType" id="btnVendorType" class="ui blue huge button">
                            <hr class="divider">
                            <div class="ui error message"></div>
                        </form>
                    </div>
                </div>
                <div class="ui ten wide computer sixteen wide tablet column">
                    <div class="row">
                        <p id="form-header" class="ui header huge">View All Vendor Type</p>
                        <div class="segment">
<?php $vendor_type = DB::getInstance()->free_run('SELECT * FROM `tab_vendor_types` WHERE `v_t_status` = 1;'); ?>
                            <table class="ui celled teal table">
                                <thead>
                                    <tr>
                                        <th>Vendor Type Name</th>
                                        <th>Vendor Type Description</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php if ( $vendor_type->count() ) {
        foreach ( $vendor_type->results() as $count => $vtype):
    ?>
                                    <tr>
                                        <td><?php echo escaper($vtype->v_t_name); ?></td>
                                        <td><?php echo escaper($vtype->v_t_desc); ?></td>
                                        <td><a onclick="return confirm('Do you want to edit this Vendor Type?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$vtype->v_t_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                        <td><a onclick="return confirm('Do you want to delete this Vendor Type?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$vtype->v_t_id; ?>"><i class="ui red trash icon"></i></a></td>
                                    </tr>
    <?php
            endforeach;
        } else {
    ?>
                                    <tr>
                                        <td colspan="3">
                                            <p class="ui orange text meta center aligned">No Vendor Type.</p>
                                        </td>
                                    </tr>
    <?php
            }
    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="ui text right aligned violet table-footer">Caption: Vendor Type Management</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="./vendors.php" alt="Back to Vendor's Page." class="ui">Back to Vendors</a>
            </div>

        </div><!--Main-content starts here-->
    </div> <!--Pusher ends here-->

<?php
    define('FOOTER', TRUE);
    include_once './admin_local_includes/overall/footer.php'; ?>

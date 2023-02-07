<?php
    define('PAGE_TITLE', 'Repair Center Management');
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
                'r_center_name'        => array(
                    'required'  => true,
                    'max'       => 50,
                    'min'       => 5,
                    'unique'    => 'tab_repair_center'
                ),
                'r_center_region'         => array(
                    'required'  => true,
                    'value'     => ""
                ),
                'r_center_nation'         => array(
                    'required'  => true,
                    'value'     => ""
                )
            ));
            if ( $validation->passed() ) {
                $repair_cntr = new User();
                try {
                    $repair_cntr->create( 'tab_repair_center', array(
                        'r_center_name'         => escaper(ucfirst(Input::get('r_center_name'))),
                        'r_center_region_id'    => escaper((int)Input::get('r_center_region')),
                        'r_center_nation_id'    => escaper((int)Input::get('r_center_nation')),
                        'r_center_status'       => 1
                    ));

                    Session::flash( 'success', 'Repair Center was successfully registered. <a href="./repair_centers.php">Continue</a>');
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
                        <p id="form-header" class="ui header huge">Add Repair Center</p>
                        <form class="ui form segment repair_center" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_repair_center_form" id="add_repair_center_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="field">
                                <label for="r_center_name">Repair Center Name:</label>
                                <input type="text" id="r_center_name" name="r_center_name" placeholder="Repair Center Name" class="" value="<?php echo escaper ( Input::get('r_center_name') ); ?>" />
                            </div>
                            <div class="field">
                                <label for="r_center_nation">Repair Center Country:</label>
                                <select name="r_center_nation" id="r_center_nation" class="ui dropdown full-dropdown">
                                    <option value="<?php if (isset($_POST['r_center_nation'])){ echo Input::get('r_center_nation');} else { echo ''; } ?>">-- Select --</option>
<?php
$nations = DB::getInstance()->get_all('tab_nations');
if ( $nations->count() ) {
    foreach ( $nations->results() as $nation):
?>
                                    <option value="<?php echo (int)$nation->n_id; ?>"><?php echo escaper(ucfirst($nation->n_name)); ?></option>
<?php endforeach; } ?>
                                </select>
                            </div>
                            <div class="field">
                                <label for="r_center_region">Repair Center Region:</label>
                                <select name="r_center_region" id="r_center_region" class="ui dropdown full-dropdown">
                                    <option value="<?php if (isset($_POST['r_center_region'])){ echo Input::get('r_center_region');} else { echo ''; } ?>">-- Select --</option>
<?php
    $regions = DB::getInstance()->get_all('tab_regions');
    if ( $regions->count() ) {
        foreach ( $regions->results() as $region):
?>
                                        <option value="<?php echo (int)$region->r_id; ?>"><?php echo escaper(ucfirst($region->region_name)); ?></option>
<?php endforeach; } ?>
                                </select>
                            </div>
                            <input type="submit" value="Add Repair Center" name="btnRepCtr" id="btnRepCtr" class="ui blue huge button">
                            <hr class="divider">
                            <div class="ui error message"></div>
                        </form>
                    </div>
                </div>
                <div class="ui ten wide computer sixteen wide tablet column">
                    <div class="row">
                        <p id="form-header" class="ui header huge">View All Repair Centers</p>
                        <div class="segment">
<?php $rp_ctr = DB::getInstance()->free_run('SELECT * FROM `tab_repair_center` WHERE `r_center_status` = 1;'); ?>
                            <table class="ui celled teal table">
                                <thead>
                                    <tr>
                                        <th>Repair Center Name</th>
                                        <th>Repair Center Region</th>
                                        <th>Repair Center Country</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php if ( $rp_ctr->count() ) {
        foreach ( $rp_ctr->results() as $count => $rc):
    ?>
                                    <tr>
                                        <td><?php echo escaper($rc->r_center_name); ?></td>
                                        <td>
<?php
    $reg = $rc->r_center_region_id;
    $access = DB::getInstance()->get('tab_regions', array('r_id', '=', $reg));
    if ($access->count()){
        $accessLevel = $access->firstResult();
    }
    echo escaper($accessLevel->region_name);
?>
                                    </td>
                                    <td>
<?php
    $nats = $rc->r_center_nation_id;
    $access = DB::getInstance()->get('tab_nations', array('n_id', '=', $nats));
    if ($access->count()){
        $accessLevel = $access->firstResult();
    }
    echo escaper($accessLevel->n_name);
?>
                                        </td>
                                        <td><a onclick="return confirm('Do you want to edit this Repair Center?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$rc->r_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                        <td><a onclick="return confirm('Do you want to delete this Repair Center?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$rc->r_id; ?>"><i class="ui red trash icon"></i></a></td>
                                    </tr>
    <?php
            endforeach;
        } else {
    ?>
                                    <tr>
                                        <td colspan="3">
                                            <p class="ui orange text meta center aligned">No Repair Center.</p>
                                        </td>
                                    </tr>
    <?php
            }
    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="ui text right aligned violet table-footer">Caption: Repair Center Management</td>
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

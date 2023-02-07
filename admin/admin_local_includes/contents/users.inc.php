            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_user.php" title="Add New User">Add A User</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Users</p>
<?php
    
    if (isset($_GET['sort']) && $_GET['sort'] === '') {
        $users = DB::getInstance()->free_run("SELECT * FROM `tab_users` WHERE `user_status` = '1' ORDER BY `user_username` ASC;");
    } else {
        $users = DB::getInstance()->get('tab_users', array('user_status', '=', '1'));
    }
?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Username <a href="<?php echo escaper ( $_SERVER['SCRIPT_NAME']) . '?sort' ?>"><i class="ui sort icon"></i></a></th>                                    
                                    <th>Access Level</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php if ( $users->count() ) {
    foreach ( $users->results() as $count => $user):            
?>
                                <tr>
                                    <td><?php echo escaper($user->user_firstname); ?></td>
                                    <td><?php echo escaper($user->user_lastname); ?></td>
                                    <td><?php echo escaper($user->user_email); ?></td>
                                    <td><?php echo escaper($user->user_mobile); ?></td>
                                    <td><?php echo escaper($user->user_username); ?></td>
                                    <td>
<?php
    $level = $user->access_level; 
    $access = DB::getInstance()->get('tab_access_permissions', array('p_id', '=', $level));
    if ($access->count()){
        $accessLevel = $access->firstResult();
    }
    echo escaper($accessLevel->p_name);
?>
                                    </td>
                                    <td><a onclick="return confirm('Do you want to edit this User?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$user->s_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this User?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$user->s_id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr>
<?php
        endforeach;
    } else { 
?>
                                <tr>
                                    <td colspan="8">
                                        <p class="ui orange text meta center aligned">No registered User.</p>
                                    </td>
                                </tr>
<?php 
        }
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete Users (User Management)</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

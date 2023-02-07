            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_account.php" title="Add New Account">Add An Account</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Accounts</p>
<?php
    
    if (isset($_GET['sort']) && $_GET['sort'] === '') {
        $accounts = DB::getInstance()->free_run("SELECT * FROM `tab_account` WHERE `account_status` = '1' ORDER BY `account_name` ASC;");
    } else {
        $accounts = DB::getInstance()->get('tab_account', array('account_status', '=', '1'));
    }
?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Account Name</th>
                                    <th>Account Address</th>
                                    <th>Account Type</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php if ( $accounts->count() ) {
    foreach ( $accounts->results() as $count => $account):            
?>
                                <tr>
                                    <td><?php echo escaper($account->account_name); ?></td>
                                    <td><?php echo escaper($account->account_address); ?></td>
                                    <td>
<?php
    $type = $account->account_type; 
    $seeType = DB::getInstance()->get('tab_account_type', array('acct_id', '=', $type));
    if ($seeType->count()){
        $access = $seeType->firstResult();
    }
    echo escaper($access->acct_name);
?>
                                    </td>
                                    <td><a onclick="return confirm('Do you want to edit this Account?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$account->account_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this Account?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$account->account_id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr>
<?php
        endforeach;
    } else { 
?>
                                <tr>
                                    <td colspan="8">
                                        <p class="ui orange text meta center aligned">No registered Account.</p>
                                    </td>
                                </tr>
<?php 
        }
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete Accounts (Account Management)</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

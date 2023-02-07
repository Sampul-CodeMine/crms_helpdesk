            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_bank.php" title="Add New Bank">Add A Bank</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Banks</p>
<?php
    $banks = DB::getInstance()->get('tab_bank', array('bank_status', '=', '1'));
?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Bank Shortname</th>
                                    <th>Bank Address</th>
                                    <th>Bank's Email</th> 
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php if ( $banks->count() ) {
    foreach ( $banks->results() as $count => $bank):            
?>
                                <tr>
                                    <td><?php echo escaper($bank->bank_name); ?></td>
                                    <td><?php echo escaper($bank->bank_shortname); ?></td>
                                    <td><?php echo escaper($bank->bank_address); ?></td>
                                    <td><?php echo escaper($bank->bank_email); ?></td>
                                    <td><a onclick="return confirm('Do you want to edit this Bank?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$bank->b_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this Bank?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$bank->b_id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr>
<?php
        endforeach;
    } else { 
?>
                                <tr>
                                    <td colspan="8">
                                        <p class="ui orange text meta center aligned">No registered Bank.</p>
                                    </td>
                                </tr>
<?php 
        }
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete (Bank Management)</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_flash_msg.php" title="Add New Message">Add A Flash Message</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Flash Messages</p>
<?php
    $flash_msg = DB::getInstance()->get('tab_moving_msgs', array('status', '=', '1'));    
?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Message About</th>
                                    <th>Message Description</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php if ( $flash_msg->count() ) {
    foreach ( $flash_msg->results() as $count => $msg):            
?>
                                <tr>
                                    <td><?php echo escaper($msg->msg_name ); ?></td>
                                    <td><?php echo escaper($msg->message); ?></td>
                                    <td><?php echo (($msg->status == '1'))? '<em class="ui green basic label">Message Active</em>' : '<em class="ui red basic label">Message Suspended</em>'; ?></td>
                                    <td><?php echo (($msg->status == '1'))? '<a href="' . $_SERVER['SCRIPT_NAME'] . '?off=true" title="Turn off this message." class="ui red basic button">Off</a>' : '<a href="' . $_SERVER['SCRIPT_NAME'] . '?on=true" class="ui green basic button" title="Turn on this message.">On</a>'; ?></td>
                                    <td><a onclick="return confirm('Do you want to edit this Message?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$msg->id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this Message?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$msg->id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr> 
<?php
        endforeach;
    } else { 
?>
                                <tr>
                                    <td colspan="5">
                                        <p class="ui orange text meta center aligned">No Flash Message Available.</p>
                                    </td>
                                </tr>
<?php 
        }
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete Messages (Flash Messages)</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

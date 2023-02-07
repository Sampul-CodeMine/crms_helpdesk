<!-- Menu to display admin's page starts here -->
<div class="ui grid stackable padded">
    <div class="ui column">
        <div class="row">
            <a class="ui green medium button" href="./add_call_type.php" title="Add New Call Type">Add Call Type</a>
            <hr class="divider">
            <p class="ui header violet text meta">View / Manage Call Type</p>

            <!-- Filtering services start here -->
            <form action="" method="post">
                <select name="call_type" id="">
                    <option value="" disabled selected>Filter by...</option>
                    <option value="call_type">Name</option>
                    <option value="sub_call_type">Code</option>
                </select>
                <input style="margin-left: 10px;" type="text" name="call_type_filter" id="call_type_filter" autocomplete="off">
                <input type="submit" name="submit" value="Filter">
            </form><br>
            <?php 
                $call_types = DB::getInstance()->get('tab_call_type', array('ct_status', '=', '1'));
            ?>
            <table class="ui celled teal table">
                <thead>
                    <tr>
                        <th>Call Type</th>
                        <th>Sub Call Type</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php 
                        if($call_types->count())
                        {
                            foreach($call_types->results() as $count=>$call_type):
                    ?>
                            <tr>
                                <td><?php echo escaper($call_type->call_type); ?></td>
                                <td><?php echo escaper($call_type->sub_call_type); ?></td>
                                <td>
                                    <a onclick="return confirm('Do you want to edit this call type?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$call_type->ct_id; ?>"><i class="ui orange pencil icon"></i></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Do you wan to delete this call type?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$call_type->ct_id; ?>"><i class="ui red trash icon"></i></a>
                                </td>
                            </tr>
                        <?php
                            endforeach;
                        } else {
                        ?>
                        <tr>
                            <td colspan="8">
                                <p class="ui orange text meta center aligned">No registered Call Type</p>
                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete (Call Type Management)</td>
                    </tr>
                </tfoot>
            </table>
            <a class="ui teal medium button" href="./admincp.php" title="Back to admin">Back</a>
            <!-- Filtering services end here -->
        </div>
    </div>
</div>
<!-- Menu to display admin's page stop here -->

<!-- Implementing live serach for service codes start here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(e){
                    $("#call_type_filter").keyup(function (){
                        var call_type = $(this).val();
                        if(call_type != ""){
                            $.ajax({
                                url: 'http://ims.localhost/admin/admin_local_includes/contents/call_type_filter.php',
                                method: 'POST',
                                data: {call_type},
                                success: function(data){
                                    $('#table_body').html(data);
                                }
                            });
                        }
                        else{}
                    });
                });
            </script>
<!-- Implementing live serach for service codes end here -->
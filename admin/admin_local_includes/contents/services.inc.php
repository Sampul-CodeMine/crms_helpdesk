<!-- Menu to display admin's page starts here -->
<div class="ui grid stackable padded">
    <div class="ui column">
        <div class="row">
            <a class="ui green medium button" href="./add_service.php" title="Add New Service Code">Add Service Code</a>
            <hr class="divider">
            <p class="ui header violet text meta">View / Manage Service</p>

            <!-- Filtering services start here -->
            <form action="" method="post">
                <select name="service_code" id="">
                    <option value="" disabled selected>Filter by...</option>
                    <option value="service_code_name">Name</option>
                    <option value="service_code">Code</option>
                </select>
                <input style="margin-left: 10px;" type="text" name="service_code_filter" id="service_code_filter" autocomplete="off">
                <input type="submit" name="submit" value="Filter">
            </form><br>
            <?php 
                $service_codes = DB::getInstance()->get('tab_service_code', array('service_code_status', '=', '1'));
            ?>
            <table class="ui celled teal table">
                <thead>
                    <tr>
                        <th>Service Code Name</th>
                        <th>Service Code</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php 
                        if($service_codes->count())
                        {
                            foreach($service_codes->results() as $count=>$service_code):
                    ?>
                            <tr>
                                <td><?php echo escaper($service_code->service_code_name); ?></td>
                                <td><?php echo escaper($service_code->service_code); ?></td>
                                <td>
                                    <a onclick="return confirm('Do you want to edit this service code name?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$service_code->sc_id; ?>"><i class="ui orange pencil icon"></i></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Do you wan to delete this service code?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$service_code->sc_id; ?>"><i class="ui red trash icon"></i></a>
                                </td>
                            </tr>
                        <?php
                            endforeach;
                        } else {
                        ?>
                        <tr>
                            <td colspan="8">
                                <p class="ui orange text meta center aligned">No registered Service Code</p>
                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete (Service Code Management)</td>
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
                    $("#service_code_filter").keyup(function (){
                        var service_code = $(this).val();
                        if(service_code != ""){
                            $.ajax({
                                url: 'http://ims.localhost/admin/admin_local_includes/contents/service_filter.php',
                                method: 'POST',
                                data: {service_code},
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
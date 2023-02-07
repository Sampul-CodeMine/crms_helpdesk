            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_location.php" title="Add New Location">Add New Location</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Locations</p>

                        <!-- Filtering location starts here -->
                        <form action="" method="post">
                            <select name="location">
                                <option value="" disabled selected>Filter by...</option>
                                <option value="location_name">Name</option>
                                <option value="location_email">Email</option>
                                <option value="state_id">State</option>
                            </select>
                            <input style="margin-left: 10px;" type="text" name="location_filter" id="location_filter" autocomplete="off">
                            <input type="submit" name="submit" value="Filter">
                        </form><br>
                        <?php
                            if (isset($_GET['sort']) && $_GET['sort'] === '') 
                            {
                                $users = DB::getInstance()->free_run("SELECT * FROM `tab_locations` WHERE `location_status` = '1' ORDER BY `location_name` ASC;");
                            } 
                            else 
                            {
                                $locations = DB::getInstance()->get('tab_locations', array('location_status', '=', '1'));
                            }
                        ?>
                        <div id="filter_locations">
                            <table class="ui celled teal table">
                                <thead>
                                    <tr>
                                        <th>Location Name <a href="<?php echo escaper($_SERVER['SCRIPT_NAME']) . '?sort' ?>"><i class="ui sort icon"></i></a></th>
                                        <th>Location Email</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Phone Number</th>
                                        <th>Repair Center</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    <?php 
                                       if($locations->count())
                                       {
                                           foreach($locations->results() as $count=>$location):
                                    ?>
                                        <tr>
                                            <td><?php echo escaper($location->location_name); ?></td>
                                            <td><?php echo escaper($location->location_email); ?></td>
                                            <td><?php echo escaper($location->address); ?></td>
                                            <td><?php $states=DB::getInstance()->get('tab_states', array('s_id', '=', (int)$location->state_id)); 
                                            if($states->count()){$db_result=$states->firstResult()->state_name; echo ucfirst($db_result);} ?></td>
                                            <td><?php echo escaper($location->phone_number); ?></td>
                                            <td><?php $rep_center=DB::getInstance()->get('tab_repair_center', array('r_id', '=', (int)$location->repair_center_id)); 
                                            if($rep_center->count()){$db_result=$rep_center->firstResult()->r_center_name; echo ucfirst($db_result);} ?></td>
                                            <td><a onclick="return confirm('Do you want to edit this location?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$location->l_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                            <td><a onclick="return confirm('Do you want to delete this location?');" name="btnEdit" id="btnEdit" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$location->l_id; ?>"><i class="ui red trash icon"></i></a></td>
                                        </tr>
                                        <?php endforeach; 
                                            }
                                            else {
                                        ?>
                                            <tr>
                                                <td colspan="8">
                                                    <p class="ui orange text meta center aligned"No registered location found.></p>
                                                </td>
                                            </tr>

                                        <?php } ?> 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete locations (Location Management)</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>                           
                        </div>
                        <!-- Filtering location ends here -->       
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

            <!-- Implementing live search for location with ajax starts here -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(e){
                    $("#location_filter").keyup(function (){
                        var location = $(this).val();
                        if(location != ""){
                            $.ajax({
                                url: 'http://ims.localhost/admin/admin_local_includes/contents/location_filter.php',
                                method: 'POST',
                                data: {location},
                                success: function(data){
                                    $('#table_body').html(data);
                                }
                            });
                        }
                        else{}
                    });
                });
            </script>
            <!-- Implementing live search for location with ajax ends here -->
            

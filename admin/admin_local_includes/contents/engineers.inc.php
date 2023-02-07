            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_engineer.php" title="Add New Engineer">Add An Engineer</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Engineers</p>

                        <!-- Filtering engineer starts here -->
                        <form action="" method="post">
                            <select name="engineer">
                                <option value="" disabled selected>Filter by...</option>
                                <option value="engr_name">Name</option>
                                <option value="engr_email">Email</option>
                                <option value="engr_code">Code</option>
                            </select>
                            <input style="margin-left: 10px;" type="text" name="engineer_filter" id="engineer_filter" autocomplete="off">
                            <input type="submit" name="submit" value="Filter">
                        </form><br>
                        <?php 
                            $engrs = DB::getInstance()->get('tab_engineer', array('engr_status', '=', '1'));
                        ?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Engineer Name</th>
                                    <th>Engineer Code</th>
                                    <th>Mobile #</th>
                                    <th>Email ID</th>
                                    <th>Location</th>
                                    <th>Vendor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                <?php 
                                    if($engrs->count())
                                    {
                                        foreach($engrs->results() as $count=>$engr):
                                ?>
                                        <tr>
                                            <td><?php echo escaper($engr->engr_name); ?></td>
                                            <td><?php echo escaper($engr->engr_code); ?></td>
                                            <td><?php echo escaper($engr->engr_mobile); ?></td>
                                            <td><?php echo escaper($engr->engr_email); ?></td>
                                            <td>
                                                <?php 
                                                    $locs = $engr->engr_location_id;
                                                    $access = DB::getInstance()->get('tab_locations', array('l_id', '=', $locs));
                                                    if($access->count())
                                                    {
                                                        $accessLevel=$access->firstResult();
                                                    }
                                                    echo escaper($accessLevel->location_name);
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $reg = $engr->engr_region_id;
                                                    $access = DB::getInstance()->get('tab_regions', array('r_id', '=', $reg));
                                                    if($access->count())
                                                    {
                                                        $accessLevel=$access->firstResult();
                                                    }
                                                    echo escaper($accessLevel->region_name);
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $nats=$engr->engr_nation_id;
                                                    $access=DB::getInstance()->get('tab_nations', array('n_id', '=', $nats));
                                                    if($access->count())
                                                    {
                                                        $accessLevel=$access->firstResult();
                                                    }    
                                                    echo escaper($accessLevel->n_name);
                                                ?>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Do you want to edit this engineer?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$engr->s_id; ?>"><i class="ui orange pencil icon"></i></a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Do you want to delete this engineer?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$engr->s_id; ?>"><i class="ui red trash icon"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                            endforeach;
                                        } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">
                                                <p class="ui orange text meta center aligned">
                                                    No registered Engineer.
                                                </p>
                                            </td>
                                        </tr>
                                        <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="ui text right aligned violet table-footer">
                                        Caption: Add, Edit, and Delete (Engineer Management)
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin">Back</a>
                    </div>
                    <!-- Filtering engineer ends here -->
                 </div>
            </div>
        </div>
        <!-- Menu to Display on the administrator's page stops here-->

        <!-- Implementing live search for location with ajax starts here -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(e){
                    $("#engineer_filter").keyup(function (){
                        var engineer = $(this).val();
                        if(engineer != ""){
                            $.ajax({
                                url: 'http://ims.localhost/admin/admin_local_includes/contents/engineer_filter.php',
                                method: 'POST',
                                data: {engineer},
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
            


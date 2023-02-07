            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_state.php" title="Add New State">Add A State</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage States</p>

                        <!-- Filtering states starts here -->
                        <form action="" method="post">
                            <select name="state">
                                <option value="" disabled selected>Filter By...</option>
                                <option value="state_name">State Name</option>
                                <option value="region_name">Region Email</option>
                                <option value="region_nation_id">Country</option>
                            </select>
                            <input style="margin-left: 10px;" type="text" name="state_filter" id="state_filter" autocomplete="off">
                            <input type="submit" name="submit" value="Filter">
                        </form><br>
                        <?php 
                            if(isset($_GET['state_name']) && $_GET['state_name'] === '')
                            {
                                $states = DB::getInstance()->free_run("SELECT * FROM `tab_states` WHERE `state_status` = '1' ORDER BY  `state_name` ASC");
                            }
                            else
                            {
                                $states = DB::getInstance()->get('tab_states', array('state_status', '=', '1'));
                            }
                        ?>
                        <div id="filter_states">
                            <table class="ui celled teal table">
                                <thead>
                                    <tr>
                                        <th>State's Region Name</th>
                                        <th>State's Nation</th>
                                        <th>State's Name <a href="<?php echo escaper($_SERVER['SCRIPT_NAME']) . '?state_name'?>"><i class="ui sort icon"></i></a></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    <?php 
                                        if($states->count())
                                        {
                                            foreach($states->results() as $count=>$state):
                                    ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    $region = DB::getInstance()->get('tab_regions', array('r_id', '=', (int)$state->region_id));
                                                    if($region->count())
                                                    {
                                                        $db_result = $region->firstResult()->region_name;
                                                        echo ucfirst($db_result);
                                                    }
                                                ?>
                                            </td>

                                            <td>
                                                <?php 
                                                    $nation = DB::getInstance()->get('tab_nations', array('n_id', '=', (int)$state->country_id));
                                                    if($nation->count())
                                                    {
                                                        $db_result = $nation->firstResult()->n_name;
                                                        echo ucfirst($db_result);
                                                    }
                                                ?>
                                            </td>
                                            
                                            <td>
                                                <a href="<?php echo $_SERVER['SCRIPT_NAME'] . '?id=' . (int)$state->s_id; ?>"><?php echo escaper(ucfirst ($state->state_name)); ?></a>
                                            </td>

                                            <td>
                                                <a onclick="return confirm('Do you want to edit this state?');" name="btnEdit"id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$state->s_id; ?>"><i class="ui orange pencil icon"></i></a>
                                            </td>

                                            <td>
                                                <a oclick="return confirm('Do you you want  to delete this state?');" name="btn Delete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$state->s_id; ?>"><i class="ui red trash icon"></i></a>
                                            </td>
                                        </tr>

                                        <?php 
                                                endforeach;
                                            }
                                            else{
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                                <p class="ui orange meta center aligned">No registered state found.</p>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete States (State Management)
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                        </div>
                        <!-- Filtering states ends here -->

                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

            <!-- Implemeting Live seacrh by state starts here -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(e){
                    $("#state_filter").keyup(function (){
                        var state = $(this).val();
                        if (state != ""){
                            $.ajax({
                                url: 'http://ims.localhost/admin/admin_local_includes/contents/state_filter.php',
                                method: 'POST',
                                data: {
                                    state: state
                                },
                                success: function(data){
                                    $('#table_body').html(data);
                                }
                            });
                        }
                        else{}
                    });
                });
            </script>
            <!-- Implemeting Live seacrh by state ends here -->



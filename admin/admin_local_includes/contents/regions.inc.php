            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_region.php" title="Add New Region">Add Region</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Regions</p>

                        <!-- Filtering region starts here -->
                        <form action="" method="post">
                            <select name="region">
                                <option value="" disabled selected>Filter By...</option>
                                <option value="region_name">Region Name</option>
                                <option value="region_email">Region Email</option>
                                <option value="region_nation_id">Country</option>
                            </select>
                            <input style="margin-left: 10px;" type="text" name="region_filter" id="region_filter" autocomplete="off">
                            <input type="submit" name="submit" value="Filter">
                        </form><br>
                        <?php     
                            if (isset($_GET['sort']) && $_GET['sort'] === '') {
                                    $regions = DB::getInstance()->free_run("SELECT * FROM `tab_regions` WHERE `region_status` = '1' ORDER BY `region_name` ASC;");
                            } else {
                                $regions = DB::getInstance()->get('tab_regions', array('region_status', '=', '1'));
                            }
                        ?>

                        <div id="filter_region">
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Region's Name <a href="<?php echo escaper ( $_SERVER['SCRIPT_NAME']) . '?sort' ?>"><i class="ui sort icon"></i></a></th>
                                    <th>Region's Email Address</th>
                                    <th>Nation Where Region Resides(Country)</th>
                                    <th></th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            <?php if ( $regions->count() ) {
                                foreach ( $regions->results() as $count => $region):            
                            ?>
                                <tr>
                                    <td><a href="<?php echo $_SERVER['SCRIPT_NAME'] . '?id=' . (int)$region->r_id; ?>"><?php echo escaper(ucfirst($region->region_name)); ?></a></td>
                                    <td><?php echo escaper(strtolower($region->region_email)); ?></td>
                                    <td>
                            <?php 
                                $nation = DB::getInstance()->get('tab_nations', array('n_id', '=', (int)$region->region_nation_id) );
                                if ( $nation->count()) {
                                    $db_result = $nation->firstResult()->n_name;
                                    echo ucfirst($db_result);
                                }
                            ?>
                                    </td>
                                    <td><a onclick="return confirm('Do you want to edit this region?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$region->r_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this region?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$region->r_id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr>
                            <?php
                                    endforeach;
                                } else { 
                            ?>
                                <tr>
                                    <td colspan="3">
                                        <p class="ui orange text meta center aligned">No registered regions found.</p>
                                    </td>
                                </tr>
                            <?php 
                                    }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete Regions (Region Management)</td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops right here-->
                        
                        <!-- making post request to the database to fecth filtered data -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function(e){
                                $("#region_filter").keyup(function (){
                                    var region = $(this).val();
                                    if (region != ""){
                                        $.ajax({
                                            url: 'http://ims.localhost/admin/admin_local_includes/contents/region_filter.php', 
                                            method: 'POST',
                                            data: {
                                                region: region
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
                        <!-- Filtering region ends here -->
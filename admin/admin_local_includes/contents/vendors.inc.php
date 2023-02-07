            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_vendor.php" title="Add New Vendor">Add A Vendor</a>
                        <a href="./vendor_type.php" class="ui orange medium button" title="Manage Vendor Types">Manage Vendor Types</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Vendors</p>
<?php
    $vendors = DB::getInstance()->get('tab_vendors', array('vendor_status', '=', '1'));
?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Vendor ID</th>
                                    <th>Vendor Name</th>
                                    <th>Vendor Email</th>
                                    <th>Vendor Address</th>  
                                    <th>Vendor City</th> 
                                    <th>Vendor State</th>
                                    <th>Vendor's Country</th>
                                    <th>Vendor PINcode</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php if ( $vendors->count() ) {
    foreach ( $vendors->results() as $count => $vendor):            
?>
                                <tr>
                                    <td><?php echo escaper($vendor->vendor_id); ?></td>
                                    <td><?php echo escaper($vendor->vendor_name); ?></td>
                                    <td><?php echo escaper($vendor->vendor_email); ?></td>
                                    <td><?php echo escaper($vendor->vendor_address); ?></td>
                                    <td><?php echo escaper($vendor->vendor_city); ?></td>
                                    <td>
<?php
    $state_id = $vendor->vendor_state_id; 
    $find = DB::getInstance()->get('tab_states', array('s_id', '=', $state_id));
    if ($find->count()){
        $access = $find->firstResult();
    }
    echo escaper($access->state_name);
?>
                                    </td>
                                    <td>
<?php
    $nation_id = $vendor->vendor_nation_id; 
    $find = DB::getInstance()->get('tab_nations', array('n_id', '=', $nation_id));
    if ($find->count()){
        $access = $find->firstResult();
    }
    echo escaper($access->n_name);
?>
                                    </td>
                                    <td><?php echo escaper($vendor->vendor_pincode); ?></td>
                                    <td><a onclick="return confirm('Do you want to edit this Vendor?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$vendor->v_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this Vendor?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$vendor->v_id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr>
<?php
        endforeach;
    } else { 
?>
                                <tr>
                                    <td colspan="8">
                                        <p class="ui orange text meta center aligned">No registered Vendor.</p>
                                    </td>
                                </tr>
<?php 
        }
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete Vendors (Vendor Management)</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

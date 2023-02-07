            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="ui column">
                    <div class="row">
                        <a class="ui green medium button" href="./add_company.php" title="Add New Company">Add A Company</a>
                        <hr class="divider">
                        <p class="ui header violet text meta">View / Manage Companies</p>
<?php
                                 
    if (isset($_GET['sort']) && $_GET['sort'] === '') {
        $companies = DB::getInstance()->free_run("SELECT * FROM `tab_companies` WHERE `company_status` = '1' ORDER BY `company_name` ASC;");
    } else {
        $companies = DB::getInstance()->get('tab_companies', array('company_status', '=', '1'));
    }
?>
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th>Company's Name <a href="<?php echo escaper ( $_SERVER['SCRIPT_NAME']) . '?sort' ?>"><i class="ui sort icon"></i></a></th>
                                    <th>Company's Email</th>
                                    <th>Company's Mobile</th>
                                    <th>Company's Address</th>
                                    <th>Company's State / Nation / Region</th>
                                    <th></th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<?php 
    
    if ( $companies->count() ) {
        foreach ( $companies->results() as $count => $company){            
?>
                                <tr>
                                    <td><a href="<?php echo $_SERVER['SCRIPT_NAME'] . '?id=' . (int)$company->c_id; ?>"><?php echo escaper(ucfirst($company->company_name)); ?></a></td>
                                    <td><?php echo escaper(strtolower($company->company_email)); ?></td>                                    
                                    <td><?php echo escaper(ucfirst($company->company_mobile)); ?></td>
                                    <td><?php echo escaper(ucwords($company->company_address)); ?></td>
                                    <td>
<?php 
    $str = '';
    $state = DB::getInstance()->get('tab_states', array('s_id', '=', (int)$company->c_state_id) );
    if ( $state->count()) {
        $db_reslt = $state->firstResult()->state_name;
        $str .=  ucfirst($db_reslt);
    }
    $nation = DB::getInstance()->get('tab_nations', array('n_id', '=', (int)$company->c_country_id) );  
    if ( $nation->count()) {
        $db_result = $nation->firstResult()->n_name;
        $str .= ' / ' . ucfirst($db_result);
    }
    $region = DB::getInstance()->get('tab_regions', array('r_id', '=', (int)$company->c_region_id) );
    if ( $region->count()) {
        $db_rezult = $region->firstResult()->region_name;
        $str .=  ' / ' . ucfirst($db_rezult);
    }
    
    echo $str;
?>
                                    </td>
                                    <td><a onclick="return confirm('Do you want to edit this Company?');" name="btnEdit" id="btnEdit" class="ui small orange" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=update&id=' . (int)$companies->c_id; ?>"><i class="ui orange pencil icon"></i></a></td>
                                    <td><a onclick="return confirm('Do you want to delete this Company?');" name="btnDelete" id="btnDelete" class="ui small red" href="<?php echo $_SERVER['SCRIPT_NAME'] . '?status=delete&id=' . (int)$companies->c_id; ?>"><i class="ui red trash icon"></i></a></td>
                                </tr>
<?php
        }
    } else { 
?>
                                <tr>
                                    <td colspan="7">
                                        <p class="ui orange text meta center aligned">No registered Company found.</p>
                                    </td>
                                </tr>
<?php 
        }
?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="ui text right aligned violet table-footer">Caption: Add, Edit, and Delete Companies (Comapny Management)</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <a class="ui teal medium button" href="./admincp.php" title="Back to admin page">Back</a>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->

            <div class="ui grid stackable padded">
                <div class="ui two wide computer column"></div>  
                <div class="ui sixteen wide tablet twelve wide computer column">
                    <div class="row">
<?php 
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(                           
                'location_name'        => array(
                    'unique'    => 'tab_locations',
                    'required'  => true,
                    'max'       => 255,
                    'min'       => 2
                ),
                'location_email'            => array(
                    'required'      => true,
                    'unique'        => 'tab_locations',
                    'isvalid_email' => true
                ),
                'location_mobile'           => array(
                    'required'          => true,
                    'isvalid_mobile'    => true
                ),
                'location_address'=> array(
                    'required'  => true
                ),
                'inventory_email'            => array(
                    'required'      => true,
                    'unique'        => 'tab_locations',
                    'isvalid_email' => true
                ),
                'location_region'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'location_nation'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'location_state'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'company'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'location_city'         => array(
                    'required'  => true,
                    'max'       => 100,
                    'min'       => 2
                ),
                'location_pincode'         => array(
                    'required'  => true,
                    'max'       => 9,
                    'min'       => 9,
                    'isvalid_PIN' => true
                ),
                'repair_center'      => array(
                    'required'  => true,
                    'value'     => ""
                )
                
            ));
            if ( $validation->passed() ) {
                $location = new User();
                
                try {
                    $location->create( 'tab_locations', array(
                        'location_name'     => escaper(ucfirst(Input::get('location_name'))),
                        'location_email'    => escaper(strtolower(Input::get('location_email'))),
                        'phone_number'      => escaper(Input::get('location_mobile')),
                        'address'           => escaper(ucwords(Input::get('location_address'))),
                        'inventory_email'   => escaper(strtolower(Input::get('inventory_email'))),
                        'state_id'          => escaper((int)Input::get('location_state')),
                        'region_id'         => escaper((int)Input::get('location_region')),                        
                        'nation_id'         => escaper((int)Input::get('location_nation')),
                        'company_id'        => escaper((int)Input::get('company')),
                        'city'              => escaper(ucfirst(Input::get('location_city'))),
                        'pin_code'          => escaper((int)Input::get('location_pincode')),
                        'repair_center_id'  => escaper((int)Input::get('repair_center')),
                        'location_status'   => 1
                    ));
                    
                    Session::flash( 'success', 'You registered the location successfully. <a href="./locations.php" title="View All Locations">Locations</a>'); 
                    if ( Session::exists('success')){
                        echo '<div class="ui success floating message"><div class="header">Success!</div>' . Session::flash("success") . '</div>';
                    }
                    exit();
                                  
                } catch ( Exception $err ) {
                    echo '<div class="ui floating error message"><div class="header">Error!</div>' . $err->getMessage() . '</div>';
                }                
            } else {
?>
            <div class="ui floating error message">                
                <div class="header">Error!</div>
<?php 
    foreach ( $validation->errors() as $error ) {
        echo $error . "<br>";
    }
?>
            </div>
<?php
            }                
        }
    }                  
?>
                        <p id="form-header" class="ui header huge">Add Location</p>
                        <hr class="divider">
                        <form class="ui form segment loca" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_location_form" id="add_location_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="two fields">
                                <div class="field">
                                    <label for="location_name">Location Name:</label>
                                    <input type="text" id="location_name" name="location_name" placeholder="Location Name" class="" value="<?php echo escaper ( Input::get('location_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="location_email">Location Email:</label>
                                    <input type="email" id="location_email" name="location_email" placeholder="location@example.com" class="" value="<?php echo escaper ( Input::get('location_email') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="location_address">Location Address:</label>
                                    <textarea id="location_address" name="location_address" placeholder="Location Address" class="addr_textarea"><?php echo escaper ( Input::get('location_address') ); ?></textarea>
                                </div>
                                <div class="field">
                                    <label for="location_mobile">Location Phone #:</label>
                                    <input type="tel" id="location_mobile" name="location_mobile" placeholder="0801-100-2000" class="" value="<?php echo escaper ( Input::get('location_mobile') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="inventory_email">Inventory Email:</label>
                                    <input type="email" id="inventory_email" name="inventory_email" placeholder="inventory@email.com" class="" value="<?php echo escaper ( Input::get('inventory_email') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="company">Companies:</label>
                                    <select name="company" id="company" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['company'])){ echo Input::get('company');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $companies = DB::getInstance()->get_all('tab_companies');
    if ( $companies->count() ) {
        foreach ( $companies->results() as $company):   
?>
                                        <option value="<?php echo (int)$company->c_id; ?>"><?php echo escaper(ucfirst($company->company_name)); ?></option>
<?php endforeach; } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field"> 
                                    <label for="location_nation">Location's Nation:</label>
                                    <select name="location_nation" id="location_nation" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['location_nation'])){ echo Input::get('location_nation');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $nations = DB::getInstance()->get_all('tab_nations');
    if ( $nations->count() ) {
        foreach ( $nations->results() as $nation):   
?>
                                        <option value="<?php echo (int)$nation->n_id; ?>"><?php echo escaper(ucfirst($nation->n_name)); ?></option>
<?php endforeach; } ?>
                                    </select>                                       
                                </div>
                                <div class="field">
                                    <label for="location_region">Location's Region:</label>
                                    <select name="location_region" id="location_region" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['location_region'])){ echo Input::get('location_region');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $regions = DB::getInstance()->get_all('tab_regions');
    if ( $regions->count() ) {
        foreach ( $regions->results() as $region):   
?>
                                        <option value="<?php echo (int)$region->r_id; ?>"><?php echo escaper(ucfirst($region->region_name)); ?></option>
<?php endforeach; } ?>                                    
                                    </select>     
                                </div>                                
                            </div>
                            <div class="two fields">
                                <div class="field"> 
                                    <label for="location_state">Location's State:</label>
                                    <select name="location_state" id="location_state" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['location_state'])){ echo Input::get('location_state');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $states = DB::getInstance()->get_all('tab_states');
    if ( $states->count() ) {
        foreach ( $states->results() as $state):   
?>
                                        <option value="<?php echo (int)$state->s_id; ?>"><?php echo escaper(ucfirst($state->state_name)); ?></option>
<?php endforeach; } ?>                                      
                                    </select>                                       
                                </div>
                                <div class="field">
                                   <label for="location_city">Location's City:</label>
                                   <input type="text" id="location_city" name="location_city" placeholder="City of Location" class="" value="<?php echo escaper ( Input::get('location_city') ); ?>" />        
                                </div>                                
                            </div>
                            
                            <div class="two fields">
                                <div class="field">
                                   <label for="location_pincode">Location's PINCode:</label>
                                   <input type="text" id="location_pincode" name="location_pincode" placeholder="0000-0000" class="" value="<?php echo escaper ( Input::get('location_pincode') ); ?>" />        
                                </div>
                                <div class="field">
                                    <label for="repair_center">Repair Center:</label>
                                    <select name="repair_center" id="repair_center" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['repair_center'])){ echo Input::get('repair_center');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $repair_centers = DB::getInstance()->get_all('tab_repair_center');
    if ( $repair_centers->count() ) {
        foreach ( $repair_centers->results() as $center):   
?>
                                        <option value="<?php echo (int)$center->r_id; ?>"><?php echo escaper(ucfirst($center->r_center_name)); ?></option>
<?php endforeach; } ?>
                                    </select>
                                </div>                                  
                            </div>
                            <div class="field">
                                <input type="submit" value="Add Location" name="btnAddLocation" id="btnAddLocation" class="ui blue massive button">
                            </div> 
                            <div class="ui error message"></div>
                            <hr class="divider">
                            <a href="./locations.php" alt="Back to Location's Page." class="ui">Back to Locations</a>
                        </form>
                   </div>               
                </div>
                <div class="ui two wide computer column"></div>
            </div>
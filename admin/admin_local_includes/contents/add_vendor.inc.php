            <div class="ui grid stackable padded">
                <div class="ui two wide computer column"></div>  
                <div class="ui sixteen wide tablet twelve wide computer column">
                    <div class="row">
<?php 
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(                           
                'vendor_id'         => array(
                    'required'  => true,
                    'max'       => 8,
                    'min'       => 8,
                    'unique'    => 'tab_vendors',
                    'isvalid_V_ID'  => true
                ),
                'vendor_name'        => array(
                    'required'  => true,
                    'max'       => 255,
                    'min'       => 5,
                    'unique'    => 'tab_vendors'
                ),
                'vendor_address'=> array(
                    'required'  => true
                ),
                'vendor_city'         => array(
                    'required'  => true,
                    'max'       => 100,
                    'min'       => 3
                ),
                'vendor_state'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'vendor_nation'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'vendor_region'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'vendor_PIN'         => array(
                    'required'  => true,
                    'max'       => 9,
                    'min'       => 4,
                    'isvalid_PIN' => true
                ),
                'vendor_email'            => array(
                    'required'      => true,
                    'unique'        => 'tab_vendors',
                    'isvalid_email' => true
                ),
                'vendor_type'           => array (
                    'required'  => true,
                    'value'     => ""
                ),
                'vendor_primary_contact_name'        => array(
                    'required'  => true,
                    'max'       => 255,
                    'min'       => 2
                ),
                'vendor_primary_contact_mobile'         => array(
                    'required'          => true,
                    'isvalid_mobile'    => true
                ),
                'vendor_primary_contact_email'          => array(
                    'required'      => true,
                    'isvalid_email' => true
                ),
                'vendor_secondary_contact_name'         => array(
                    'required'  => true,
                    'max'       => 255,
                    'min'       => 2
                ),
                'vendor_secondary_contact_mobile'       => array(
                    'required'          => true,
                    'isvalid_mobile'    => true
                ),
                'vendor_secondary_contact_email'        => array(
                    'required'      => true,
                    'isvalid_email' => true
                )
            ));
            if ( $validation->passed() ) {
                $vendor = new User();
                            
                try {
                    $vendor->create( 'tab_vendors', array(
                        'vendor_id'         => escaper(strtoupper(Input::get('vendor_id'))),                        
                        'vendor_name'       => escaper(ucwords(Input::get('vendor_name'))),
                        'vendor_city'       => escaper(ucfirst(Input::get('vendor_city'))),
                        'vendor_email'      => escaper(strtolower(Input::get('vendor_email'))),
                        'vendor_pincode'    => escaper(Input::get('vendor_PIN')),
                        'vendor_address'    => escaper(ucwords(Input::get('vendor_address'))),
                        'vendor_state_id'   => escaper((int)Input::get('vendor_state')),
                        'vendor_nation_id'  => escaper((int)Input::get('vendor_nation')),
                        'vendor_region_id'  => escaper((int)Input::get('vendor_region')),
                        'vendor_type_id'    => escaper((int)Input::get('vendor_type')),
                        'vendor_primary_contact_name'      => escaper ( ucwords ( Input::get ( 'vendor_primary_contact_name' ) ) ),
                        'vendor_primary_contact_mobile'    => escaper ( Input::get ( 'vendor_primary_contact_mobile' ) ),
                        'vendor_primary_contact_email'     => escaper ( strtolower ( Input::get ( 'vendor_primary_contact_email' ) ) ),
                        'vendor_secondary_contact_name'    => escaper ( ucwords ( Input::get ( 'vendor_secondary_contact_name' ) ) ),
                        'vendor_secondary_contact_mobile'  => escaper ( strtoupper ( Input::get ( 'vendor_secondary_contact_mobile' ) ) ),
                        'vendor_secondary_contact_email'   => escaper ( strtolower ( Input::get ( 'vendor_secondary_contact_email' ) ) ),
                        'vendor_status'   => 1
                    ));
                                        
                    Session::flash( 'success', 'You registered the Vendor successfully. <a href="./vendors.php" title="View All Vendors">Vendors</a>'); 
                    if ( Session::exists('success')){
                        echo '<div class="ui success floating message"><div class="header">Success!</div>' . Session::flash("success") . '</div>';
                    }
                    exit();
                                  
                } catch ( Exception $err ) {
                    die ( $err->getMessage() );
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
                        <p id="form-header" class="ui header huge">Add Vendor</p>
                        <hr class="divider">
                        <form class="ui form segment vendor" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_vendor_form" id="add_vendor_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="three fields">
                                <div class="field">
                                    <label for="vendor_id">Vendor ID:</label>
                                    <input readonly type="text" id="vendor_id" name="vendor_id" placeholder="Vendor ID" class="" value="<?php echo escaper ( Input::get('vendor_id') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="user_lastname">Vendor Name:</label>
                                    <input type="text" id="vendor_name" name="vendor_name" placeholder="Vendor Name" class="" value="<?php echo escaper ( Input::get('vendor_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_city">Vendor City:</label>
                                    <input type="text" id="vendor_city" name="vendor_city" placeholder="Vendor City" class="" value="<?php echo escaper ( Input::get('vendor_city') ); ?>" />
                                </div>
                            </div>
                            <div class="three fields">
                                <div class="field">
                                    <label for="vendor_email">Vendor Email:</label>
                                    <input type="email" id="vendor_email" name="vendor_email" placeholder="vendor@mail.com" class="" value="<?php echo escaper ( Input::get('vendor_email') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_PIN">Vendor PINcode:</label>
                                    <input type="text" id="vendor_PIN" name="vendor_PIN" placeholder="0000-0000" class="" value="<?php echo escaper ( Input::get('vendor_PIN') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_address">Vendor Address:</label>
                                    <textarea id="vendor_address" name="vendor_address" placeholder="Vendor Address" class="addr_textarea"><?php echo escaper ( Input::get('vendor_address') ); ?></textarea>
                                </div>
                            </div>
                            <div class="two fields">
                               <div class="field">
                                   <label for="vendor_nation">Vendor Country:</label>
                                    <select name="vendor_nation" id="vendor_nation" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['vendor_nation'])){ echo Input::get('vendor_nation');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="vendor_region">Vendor Region:</label>
                                    <select name="vendor_region" id="vendor_region" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['vendor_region'])){ echo Input::get('vendor_region');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="vendor_state">Vendor State:</label>
                                    <select name="vendor_state" id="vendor_state" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['vendor_state'])){ echo Input::get('vendor_state');} else { echo ''; } ?>">-- Select --</option>
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
                                   <label for="vendor_type">Vendor Type:</label>
                                    <select name="vendor_type" id="vendor_type" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['vendor_type'])){ echo Input::get('vendor_type');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $types = DB::getInstance()->get_all('tab_vendor_types');
    if ( $types->count() ) {
        foreach ( $types->results() as $type):   
?>
                                        <option value="<?php echo (int)$type->v_t_id; ?>"><?php echo escaper(ucfirst($type->v_t_name)); ?></option>
<?php endforeach; } ?>   
                                    </select>
                                </div>
                            </div>
                            <h4 class="ui dividing header">Primary Contact</h4>
                            <div class="three fields">                                
                                <div class="field">
                                    <label for="vendor_primary_contact_name">Name:</label>
                                    <input type="text" id="vendor_primary_contact_name" name="vendor_primary_contact_name" placeholder="Pry. Contact Name" class="" value="<?php echo escaper ( Input::get('vendor_primary_contact_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_primary_contact_mobile">Mobile:</label>
                                    <input type="text" id="vendor_primary_contact_mobile" name="vendor_primary_contact_mobile" placeholder="0801-100-2000" class="" value="<?php echo escaper ( Input::get('vendor_primary_contact_mobile') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_primary_contact_email">Email:</label>
                                    <input type="email" id="vendor_primary_contact_email" name="vendor_primary_contact_email" placeholder="pry.contact@mail.com" class="" value="<?php echo escaper ( Input::get('vendor_primary_contact_email') ); ?>" />
                                </div>
                            </div>
                            <h4 class="ui dividing header">Secondary Contact</h4>
                            <div class="three fields">                                
                                <div class="field">
                                    <label for="vendor_secondary_contact_name">Name:</label>
                                    <input type="text" id="vendor_secondary_contact_name" name="vendor_secondary_contact_name" placeholder="Sec. Contact Name" class="" value="<?php echo escaper ( Input::get('vendor_secondary_contact_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_secondary_contact_mobile">Mobile:</label>
                                    <input type="text" id="vendor_secondary_contact_mobile" name="vendor_secondary_contact_mobile" placeholder="0801-100-2000" class="" value="<?php echo escaper ( Input::get('vendor_secondary_contact_mobile') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="vendor_secondary_contact_email">Email:</label>
                                    <input type="email" id="vendor_secondary_contact_email" name="vendor_secondary_contact_email" placeholder="sec.contact@mail.com" class="" value="<?php echo escaper ( Input::get('vendor_secondary_contact_email') ); ?>" />
                                </div>
                            </div>
                            <input type="submit" value="Add Vendor" name="btnAddVendor" id="btnAddVendor" class="ui blue huge button">
                            <div class="ui error message"></div>
                            <hr class="divider">
                            <a href="./vendors.php" alt="Back to Vendor's Page." class="ui">Back to Vendors</a>
                        </form>
                   </div>               
                </div>
                <div class="ui two wide computer column"></div>
            </div>
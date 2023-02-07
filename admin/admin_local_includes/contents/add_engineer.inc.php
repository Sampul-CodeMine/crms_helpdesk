            <div class="ui grid stackable padded">
                <div class="ui two wide computer column"></div>  
                <div class="ui sixteen wide tablet twelve wide computer column">
                    <div class="row">
<?php 
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(                           
                'engr_name'        => array(
                    'required'  => true,
                    'max'       => 32,
                    'min'       => 2
                ),
                'engr_email'            => array(
                    'required'      => true,
                    'unique'        => 'tab_engineer',
                    'isvalid_email' => true
                ),
                'engr_mobile'           => array(
                    'required'          => true,
                    'isvalid_mobile'    => true
                ),
                'engr_vendor'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'engr_region'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'engr_nation'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'engr_location'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'engr_code'         => array(
                    'required'  => true,
                    'max'       => 9,
                    'min'       => 9,
                    'unique'    => 'tab_engineer',
                    'isvalid_E_Code'  => true
                )
            ));
            if ( $validation->passed() ) {
                $engineer = new User();
                
                try {
                    $engineer->create( 'tab_engineer', array(
                        'engr_name'    => escaper(ucwords(Input::get('engr_name'))),
                        'engr_email'    => escaper(strtolower(Input::get('engr_email'))),
                        'engr_mobile'    => escaper(Input::get('engr_mobile')),
                        'engr_code'    => escaper(strtoupper(Input::get('engr_code'))),
                        'engr_vendor_id'    => escaper((int)Input::get('engr_vendor')),
                        'engr_region_id'    => escaper((int)Input::get('engr_region')),
                        'engr_nation_id'    => escaper((int)Input::get('engr_nation')),
                        'engr_status'       => 1,
                        'engr_location_id'  => escaper((int)Input::get('engr_location'))
                    ));
                                    
                    Session::flash( 'success', 'You registered the Engineer successfully. <a href="./engineers.php" title="View All Engineers">Engineers</a>'); 
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
                        <p id="form-header" class="ui header huge">Add Engineer</p>
                        <hr class="divider">
                        <form class="ui form segment engr" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_engr_form" id="add_engr_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="two fields">
                                <div class="field">
                                    <label for="engr_name">Engineer's Name:</label>
                                    <input type="text" id="engr_name" name="engr_name" placeholder="Engineer's Name" class="" value="<?php echo escaper ( Input::get('engr_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="engr_email">Engineer's Email:</label>
                                    <input type="email" id="engr_email" name="engr_email" placeholder="email@example.com" class="" value="<?php echo escaper ( Input::get('engr_email') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="engr_code">Engineer's Code:</label>
                                    <input type="text" readonly id="engr_code" name="engr_code" placeholder="0000-0000" class="" value="<?php echo escaper ( Input::get('engr_code') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="engr_mobile">Engineer's Mobile:</label>
                                    <input type="tel" id="engr_mobile" name="engr_mobile" placeholder="0801-100-2000" class="" value="<?php echo escaper ( Input::get('engr_mobile') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="engr_vendor">Engr Vendor:</label>
                                    <select name="engr_vendor" id="engr_vendor" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['engr_vendor'])){ echo Input::get('engr_vendor');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $vtypes = DB::getInstance()->get_all('tab_vendor_types');
    if ( $vtypes->count() ) {
        foreach ( $vtypes->results() as $vtype):   
?>
                                        <option value="<?php echo (int)$vtype->v_t_id; ?>"><?php echo escaper(ucfirst($vtype->v_t_name)); ?></option>
<?php endforeach; } ?>
                                    </select> 
                                </div>
                                <div class="field">
                                    <label for="engr_nation">Engr Country:</label>
                                    <select name="engr_nation" id="engr_nation" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['engr_nation'])){ echo Input::get('engr_nation');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $nations = DB::getInstance()->get_all('tab_nations');
    if ( $nations->count() ) {
        foreach ( $nations->results() as $nation):   
?>
                                        <option value="<?php echo (int)$nation->n_id; ?>"><?php echo escaper(ucfirst($nation->n_name)); ?></option>
<?php endforeach; } ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="engr_region">Engr Region:</label>
                                    <select name="engr_region" id="engr_region" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['engr_region'])){ echo Input::get('engr_region');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $regions = DB::getInstance()->get_all('tab_regions');
    if ( $regions->count() ) {
        foreach ( $regions->results() as $region):   
?>
                                        <option value="<?php echo (int)$region->r_id; ?>"><?php echo escaper(ucfirst($region->region_name)); ?></option>
<?php endforeach; } ?>
                                    </select> 
                                </div>
                                <div class="field">
                                    <label for="engr_location">Engr Location:</label>
                                    <select name="engr_location" id="engr_location" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['engr_location'])){ echo Input::get('engr_location');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $locations = DB::getInstance()->get_all('tab_locations');
    if ( $locations->count() ) {
        foreach ( $locations->results() as $location):   
?>
                                        <option value="<?php echo (int)$location->l_id; ?>"><?php echo escaper(ucfirst($location->location_name)); ?></option>
<?php endforeach; } ?>
                                    </select> 
                                </div>                                
                            </div>
                            <input type="submit" value="Add Engineer" name="btnAddEngr" id="btnAddEngr" class="ui blue huge button">
                            <div class="ui error message"></div>
                            <hr class="divider">
                            <a href="./engineers.php" alt="Back to Engineer's Page." class="ui">Back to Engineers</a>
                        </form>
                   </div>               
                </div>
                <div class="ui two wide computer column"></div>
            </div>
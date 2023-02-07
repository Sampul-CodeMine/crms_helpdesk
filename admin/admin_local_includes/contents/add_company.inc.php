            <div class="ui grid stackable padded">
                <div class="ui two wide computer column"></div>  
                <div class="ui sixteen wide tablet twelve wide computer column">
                    <div class="row">
<?php 

    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(
                           
                'company_name'           => array(
                    'required'  => true,
                    'unique'    => 'tab_companies',
                    'max'       => 255,
                    'min'       => 5,
                ),
                'company_email'          => array(
                    'required'  => true,
                    'unique'    => 'tab_companies',
                    'isvalid_email'   => true
                ),
                'company_mobile'           => array(
                    'required'          => true,
                    'isvalid_mobile'    => true
                ),
                'company_address'=> array(
                    'required'  => true
                ),
                'company_region'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'company_state'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'company_nation'=> array(
                    'required'  => true,
                    'value'     => ""
                )
                
            ));

            if ( $validation->passed() ) {
                
                $company = new User();
                
                try {
                    $company->create( 'tab_companies', array(
                        'company_name'          => escaper ( ucwords ( Input::get ( 'company_name' ))),
                        'company_email'         => escaper ( strtolower ( Input::get ( 'company_email' ))),
                        'company_mobile'        => escaper (Input::get('company_mobile')),
                        'company_address'       => escaper ( ucwords(Input::get('company_address'))),
                        'c_state_id'            => (int) escaper ( Input::get ( 'company_state')),    
                        'c_region_id'           => (int) escaper ( Input::get ( 'company_region')),
                        'c_country_id'          => (int) escaper ( Input::get ( 'company_nation')),
                        'company_status'        => 1
                    ));
                    
                    Session::flash('success', 'You successfully registered the Company. <a href="./companies.php" title="View All Companies">Companies</a>');
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
                        <p id="form-header" class="ui header huge center aligned">Add Company</p>
                        <hr class="divider">
                        <form class="ui form segment company" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_company_form" id="add_company_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="two fields">
                                <div class="field">
                                    <label for="company_name">Company Name:</label>
                                    <input type="text" id="company_name" name="company_name" placeholder="Company Name" class="" value="<?php echo escaper ( Input::get('company_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="company_email">Company's Email ID:</label>
                                    <input type="email" id="company_email" name="company_email" placeholder="company@email.com" class="" value="<?php echo escaper ( Input::get('company_email') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="company_mobile">Company Mobile Number:</label>
                                    <input type="tel" id="company_mobile" name="company_mobile" placeholder="0801-100-2000" class="" value="<?php echo escaper ( Input::get('company_mobile') ); ?>" />
                                </div>                                
                                <div class="field">
                                   <label for="company_nation">Company's Country:</label>
                                   <select name="company_nation" id="company_nation" class="ui dropdown full-dropdown">
                                       <option value="<?php if (isset($_POST['company_nation'])){ echo Input::get('company_nation');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="company_region">Company's Region:</label>
                                    <select name="company_region" id="company_region" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['company_region'])){ echo Input::get('company_region');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="company_state">Company's State:</label>
                                    <select name="company_state" id="company_state" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['company_state'])){ echo Input::get('company_state');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $states = DB::getInstance()->get_all('tab_states');
    if ( $states->count() ) {
        foreach ( $states->results() as $state):   
?>
                                        <option value="<?php echo (int)$state->s_id; ?>"><?php echo escaper(ucfirst($state->state_name)); ?></option>
<?php endforeach; } ?>
                                    </select>                                       
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="company_address">Company's Address:</label>
                                    <textarea id="company_address" name="company_address" placeholder="Company Address" class="addr_textarea"><?php echo escaper ( Input::get('company_address') ); ?></textarea>
                                </div> 
                            </div>
                            <input type="submit" value="Add Company" name="btnAddCompany" id="btnAddCompany" class="ui blue massive button">
                            <div class="ui error message"></div>
                            <hr class="divider">
                            <a href="./companies.php" alt="Back to Companies' Page." class="ui">Back to Companies</a>
                        </form>
                   </div>               
                </div>
                <div class="ui two wide computer column"></div>
            </div>
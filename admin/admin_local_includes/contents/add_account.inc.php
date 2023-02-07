            <div class="ui grid stackable padded">
                <div class="ui two wide computer column"></div>  
                <div class="ui sixteen wide tablet twelve wide computer column">
                    <div class="row">
<?php 
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(                           
                'user_firstname'        => array(
                    'required'  => true,
                    'max'       => 32,
                    'min'       => 2,
                ),
                'user_lastname'         => array(
                    'required'  => true,
                    'max'       => 32,
                    'min'       => 2,
                ),
                'user_email'            => array(
                    'required'      => true,
                    'unique'        => 'tab_users',
                    'isvalid_email' => true
                ),
                'user_mobile'           => array(
                    'required'          => true,
                    'isvalid_mobile'    => true
                ),
                'user_contact_address'=> array(
                    'required'  => true
                ),
                'user_region'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'user_state'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'user_nation'=> array(
                    'required'  => true,
                    'value'     => ""
                ),
                'user_username'         => array(
                    'required'  => true,
                    'max'       => 20,
                    'min'       => 5,
                    'unique'    => 'tab_users'
                ),
                'user_password'         => array(
                    'required'  => true,
                    'max'       => 32,
                    'min'       => 6
                ),
                'confirm_password'      => array(
                    'required'  => true,
                    'matches'   => 'user_password'
                ),
                'user_access'           => array (
                    'required'  => true,
                    'value'     => ""
                ),
                'user_DOB'              => array(
                    'required'  => true
                )
            ));
            if ( $validation->passed() ) {
                $user = new User();
                $salt = Hash::salt(32);
                $date = date('m/d/Y', strtotime(Input::get('user_DOB')));
                
                try {
                    $user->create( 'tab_users', array(
                        'user_firstname'    => escaper(ucfirst(Input::get('user_firstname'))),                        
                        'user_lastname'    => escaper(ucfirst(Input::get('user_lastname'))),
                        'user_email'    => escaper(strtolower(Input::get('user_email'))),
                        'user_mobile'    => escaper(Input::get('user_mobile')),
                        'user_address'    => escaper(ucwords(Input::get('user_contact_address'))),
                        'user_city'    => escaper(ucwords(Input::get('user_city'))),
                        'state_id'    => escaper((int)Input::get('user_state')),
                        'region_id'    => escaper((int)Input::get('user_region')),
                        'country_id'    => escaper((int)Input::get('user_nation')),
                        'user_username'      => escaper ( strtoupper ( Input::get ( 'user_username' ) ) ),
                        'plain_password' => escaper ( Input::get ( 'user_password' ) ),
                        'password'  => Hash::make(Input::get('user_password'), $salt),
                        'salt'          => $salt,
                        'created'        => date('Y-m-d H:i:s'),
                        'user_status'   => 1,
                        'user_dob'      => $date,
                        'access_level' => escaper((int)Input::get('user_access'))
                    ));
                                        
                    Session::flash( 'success', 'You registered the user successfully. Let the user log in now.  <a href="./users.php" title="View All Users">Users</a>'); 
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
                        <p id="form-header" class="ui header huge">Add User</p>
                        <hr class="divider">
                        <form class="ui form segment user" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_user_form" id="add_user_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="two fields">
                                <div class="field">
                                    <label for="user_firstname">First Name:</label>
                                    <input type="text" id="user_firstname" name="user_firstname" placeholder="First Name" class="" value="<?php echo escaper ( Input::get('user_firstname') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="user_lastname">Last Name:</label>
                                    <input type="text" id="user_lastname" name="user_lastname" placeholder="Last Name" class="" value="<?php echo escaper ( Input::get('user_lastname') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="user_email">User's Email ID:</label>
                                    <input type="email" id="user_email" name="user_email" placeholder="user@email.com" class="" value="<?php echo escaper ( Input::get('user_email') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="user_mobile">Mobile Number:</label>
                                    <input type="tel" id="user_mobile" name="user_mobile" placeholder="0801-100-2000" class="" value="<?php echo escaper ( Input::get('user_mobile') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="user_contact_address">User's Address:</label>
                                    <textarea id="user_contact_address" name="user_contact_address" placeholder="Contact Address" class="addr_textarea"><?php echo escaper ( Input::get('user_contact_address') ); ?></textarea>
                                </div>
                                <div class="field">
                                    <label for="user_city">User's City:</label>
                                    <input type="text" id="user_city" name="user_city" placeholder="User City" class="" value="<?php echo escaper ( Input::get('user_city') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                   <label for="user_nation">User's Country:</label>
                                    <select name="user_nation" id="user_nation" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['user_nation'])){ echo Input::get('user_nation');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="user_region">User's Region:</label>
                                    <select name="user_region" id="user_region" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['user_region'])){ echo Input::get('user_region');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="user_state">User's State:</label>
                                    <select name="user_state" id="user_state" class="ui dropdown full-dropdown">
                                        <option value="<?php if (isset($_POST['user_state'])){ echo Input::get('user_state');} else { echo ''; } ?>">-- Select --</option>
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
                                    <label for="user_DOB">Date of Birth:</label>
                                    <input type="date" id="user_DOB" name="user_DOB" placeholder="Date of Birth" class="" value="<?php echo escaper ( Input::get('user_DOB') ); ?>" />
                                </div>
                            </div>
                            <div class="field">
                                <h4 class="ui dividing header">User Login Credential</h4>
                                <div class="two fields">
                                    <div class="field">
                                        <label for="user_username">Choose Username:</label>
                                        <input type="text" id="user_username" name="user_username" placeholder="Choose Username" class="" value="<?php echo escaper ( Input::get('user_username') ); ?>" />
                                    </div>
                                    <div class="field">
                                        <label for="user_access">User's Level:</label>
                                        <select name="user_access" id="user_access" class="ui dropdown full-dropdown">
                                            <option value="<?php if (isset($_POST['user_access'])){ echo Input::get('user_access');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $accesses = DB::getInstance()->get_all('tab_access_permissions');
    if ( $accesses->count() ) {
        foreach ( $accesses->results() as $access):   
?>
                                            <option value="<?php echo (int)$access->p_id; ?>"><?php echo escaper(ucfirst($access->p_name)); ?></option>
<?php endforeach; } ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label for="user_password">Choose Password:</label>
                                        <input type="password" id="user_password" name="user_password" placeholder="Choose Password" class="" value="" />
                                    </div>
                                    <div class="field">
                                        <label for="confirm_password">Confirm Password:</label>
                                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="" value="" />
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Add User" name="btnAddUser" id="btnAddUser" class="ui blue huge button">
                            <div class="ui error message"></div>
                            <hr class="divider">
                            <a href="./users.php" alt="Back to User's Page." class="ui">Back to Users</a>
                        </form>
                   </div>               
                </div>
                <div class="ui two wide computer column"></div>
            </div>
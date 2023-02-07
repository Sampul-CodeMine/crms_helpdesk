            <div class="ui grid stackable padded">
                <div class="ui five wide computer four wide tablet column"></div>
                <div class="ui six wide computer eight wide tablet column">
<?php 

    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(
                           
                'state_name'            => array(
                    'required'  => true,
                    'unique'    => 'tab_states'
                ),
                'state_region'          => array(
                    'required'  => true,
                    'value'     => ""
                ),
                'state_nation'          => array(
                    'required'  => true,
                    'value'     => ""
                )                
            ));

            if ( $validation->passed() ) {
                
                $state = new User();
                
                try {
                    $state->create( 'tab_states', array(
                        'state_name'        => escaper ( ucfirst ( Input::get ( 'state_name' ) ) ),
                        'region_id'         => (int) escaper ( Input::get ( 'state_region' ) ),
                        'country_id'        => (int) escaper ( Input::get ( 'state_nation' ) ),
                        'state_status'      => 1
                    ));
                    
                    Session::flash('success', 'You successfully registered the State. <a href="./states.php" title="View All States">States</a>');
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
                    <p id="form-header" class="ui header huge center aligned">Add State</p>
                    <hr class="divider">
                    <form class="ui form segment state" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_state_form" id="add_state_form">
                        <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                        <div class="field">
                            <label for="state_name">State Name:</label>
                            <input type="text" id="state_name" name="state_name" placeholder="State Name" class="" autocomplete="on" value="<?php echo escaper ( Input::get('state_name') ); ?>" />
                        </div>
                        <div class="field">
                            <label for="state_nation">State's Country:</label>
                            <select name="state_nation" id="state_nation" class="ui dropdown full-dropdown">
                                <option value="<?php if (isset($_POST['state_nation'])){ echo Input::get('state_nation');} else { echo ''; } ?>">-- Select --</option>
<?php
    $nations = DB::getInstance()->get_all('tab_nations');
                                
    if ( $nations->count() ) {
        foreach ( $nations->results() as $nation):   
?>
                                <option value="<?php echo (int)$nation->n_id; ?>"><?php echo escaper(ucfirst($nation->n_name)); ?></option>
<?php 
        endforeach; } ?>
                            </select>
                       </div>
                        <div class="field">
                            <label for="state_region">State's Region:</label>
                            <select name="state_region" id="state_region" class="ui dropdown full-dropdown">
                                <option value="<?php if (isset($_POST['state_region'])){ echo Input::get('state_region');} else { echo ''; } ?>">-- Select --</option>
<?php
    $regions = DB::getInstance()->get_all('tab_regions');
                                
    if ( $regions->count() ) {
        foreach ( $regions->results() as $region):   
?>
                                <option value="<?php echo (int)$region->r_id; ?>"><?php echo escaper(ucfirst($region->region_name)); ?></option>
<?php 
        endforeach; } ?>
                            </select>    
                        </div>
                        <input type="submit" value="Add State" name="btnAddState" id="btnAddState" class="ui blue fluid button">
                        <div class="ui error message"></div>  
                        <hr class="divider">
                        <a href="./states.php" alt="Back to States Page." class="ui">Back to States</a>          
                    </form>
                </div>
                <div class="ui five wide computer four wide tablet column"></div>
            </div>
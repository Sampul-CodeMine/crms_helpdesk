            <div class="ui grid stackable padded">
                <div class="ui five wide computer four wide tablet column"></div>
                <div class="ui six wide computer eight wide tablet column">
<?php 

    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(
                           
                'region_name'           => array(
                    'required'  => true,
                    'unique'    => 'tab_regions'
                ),
                'region_email'          => array(
                    'required'  => true,
                    'unique'    => 'tab_regions',
                    'isvalid_email'   => true
                ),
                'region_nation'         => array(
                    'required'  => true,
                    'value'     => ""
                )
                
            ));

            if ( $validation->passed() ) {
                
                $region = new User();
                
                try {
                    $region->create( 'tab_regions', array(
                        'region_name'       => escaper ( ucfirst ( Input::get ( 'region_name' ) ) ),
                        'region_email'      => escaper ( strtolower ( Input::get ( 'region_email' ) ) ),
                        'region_nation_id'  => (int) escaper ( Input::get ( 'region_nation' ) ),
                        'region_status'     => 1
                    ));
                    
                    Session::flash('success', 'You successfully registered the region. <a href="./regions.php" title="View All Regions">Regions</a>');
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
                    <p id="form-header" class="ui header huge center aligned">Add Region</p>
                    <hr class="divider">
                    <form class="ui form segment region" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_region_form" id="add_region_form">
                        <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                        <div class="field">
                            <label for="region_name">Region Name:</label>
                            <input type="text" id="region_name" name="region_name" placeholder="Region Name" class="" autocomplete="on" value="<?php echo escaper ( Input::get('region_name') ); ?>" />
                        </div>
                        <div class="field">
                            <label for="region_email">Region's Email ID:</label>
                            <input type="email" id="region_email" name="region_email" placeholder="region@exmple.com" class="" value="<?php echo escaper ( Input::get('region_email') ); ?>" />
                        </div>
                        <div class="field">
                            <label for="region_nation">Region's Country:</label>
                            <select name="region_nation" id="region_nation" class="ui dropdown full-dropdown">
                                <option value="<?php if (isset($_POST['region_nation'])){ echo Input::get('region_nation');} else { echo ''; } ?>">-- Select --</option>
<?php 
    $nations = DB::getInstance()->get_all('tab_nations');
    if ( $nations->count() ) {
        foreach ( $nations->results() as $nation):  
?>
                                <option value="<?php echo (int)$nation->n_id; ?>"><?php echo escaper(ucfirst($nation->n_name)); ?></option>
<?php endforeach; } ?>
                            </select>    
                        </div>
                        <input type="submit" value="Add Region" name="btnAddRegion" id="btnAddRegion" class="ui blue fluid button">
                        <div class="ui error message"></div>    
                        <hr class="divider">
                        <a href="./regions.php" alt="Back to Regions Page." class="ui">Back to Regions</a>        
                    </form>
                </div>
                <div class="ui five wide computer four wide tablet column"></div>
            </div>
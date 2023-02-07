            <div class="ui grid stackable padded">
                <div class="ui two wide computer column"></div>  
                <div class="ui sixteen wide tablet twelve wide computer column">
                    <div class="row">
<?php 
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(                           
                'bank_name'        => array(
                    'required'  => true,
                    'max'       => 50,
                    'min'       => 5,
                    'unique'    => 'tab_bank',
                ),
                'bank_email'            => array(
                    'required'      => true,
                    'unique'        => 'tab_bank',
                    'isvalid_email' => true
                ),
                'bank_shortname'           => array(
                    'required'  => true,
                    'max'       => 3,
                    'min'       => 3,                    
                    'unique'    => 'tab_bank'
                ),
                'bank_address'=> array(
                    'required'  => true,
                    'min'       => 3
                ),
                'bank_account'         => array(
                    'required'  => true,
                    'max'       => 10,
                    'min'       => 10,
                    'unique'    => 'tab_bank'
                )
            ));
            if ( $validation->passed() ) {
                $engineer = new User();
                
                try {
                    $engineer->create( 'tab_bank', array(
                        'bank_name'    => escaper(ucwords(Input::get('bank_name'))),
                        'bank_shortname'    => escaper(strtoupper(Input::get('bank_shortname'))),
                        'bank_email'    => escaper(strtolower(Input::get('bank_email'))),
                        'bank_account'    => escaper(Input::get('bank_account')),
                        'bank_address'    => escaper(ucwords(Input::get('bank_address'))),
                        'bank_status'       => 1
                    ));
                                    
                    Session::flash( 'success', 'You registered the Bank successfully. <a href="./banks.php" title="View All Banks">Banks</a>'); 
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
                        <p id="form-header" class="ui header huge">Add Bank</p>
                        <hr class="divider">
                        <form class="ui form segment bank" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_bank_form" id="add_bank_form">
                            <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                            <div class="three fields">
                                <div class="field">
                                    <label for="bank_name">Bank's Name:</label>
                                    <input type="text" id="bank_name" name="bank_name" placeholder="Bank's Name" class="" value="<?php echo escaper ( Input::get('bank_name') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="bank_shortname">Bank's Shortname:</label>
                                    <input type="text" id="bank_shortname" name="bank_shortname" placeholder="Bank's Shortname" class="" value="<?php echo escaper ( Input::get('bank_shortname') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="bank_email">Bank's Email:</label>
                                    <input type="email" id="bank_email" name="bank_email" placeholder="email@example.com" class="" value="<?php echo escaper ( Input::get('bank_email') ); ?>" />
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="bank_account">Bank's Account:</label>
                                    <input type="text" id="bank_account" name="bank_account" placeholder="0000000000" class="" value="<?php echo escaper ( Input::get('bank_account') ); ?>" />
                                </div>
                                <div class="field">
                                    <label for="bank_address">Bank's Address:</label>
                                    <textarea id="bank_address" name="bank_address" placeholder="Bank Address" class="addr_textarea"><?php echo escaper ( Input::get('bank_address') ); ?></textarea>
                                </div> 
                            </div>
                            <input type="submit" value="Add Bank" name="btnAddbank" id="btnAddbank" class="ui blue huge button">
                            <div class="ui error message"></div>
                            <hr class="divider">
                            <a href="./banks.php" alt="Back to Bank's Page." class="ui">Back to Banks</a>
                        </form>
                   </div>               
                </div>
                <div class="ui two wide computer column"></div>
            </div>
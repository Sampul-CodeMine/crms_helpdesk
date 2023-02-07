            <div class="ui grid stackable padded">
                <div class="ui five wide computer four wide tablet column"></div>
                <div class="ui six wide computer eight wide tablet column">
<?php 

    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(
                           
                'msg_name'              => array(
                    'required'  => true,
                    'unique'    => 'tab_moving_msgs',
                    'max'       => 100,
                    'min'       => 5                    
                ),
                'message_desc'          => array(
                    'required'  => true
                )                
            ));

            if ( $validation->passed() ) {
                
                $flash_msg = new User();
                
                try {
                    $flash_msg->create( 'tab_moving_msgs', array(
                        'msg_name'          => escaper ( ucwords ( Input::get ( 'msg_name' ) ) ),
                        'message'      => escaper ( Input::get ( 'message_desc' ) ),
                        'status'            => 1
                    ));
                    
                    Session::flash('success', 'You successfully added a News Flash. <a href="./flash_msg.php" title="View All News Flash Messages">Flash Messages</a>');
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
                    <p id="form-header" class="ui header huge center aligned">Add Region</p>
                    <hr class="divider">
                    <form class="ui form segment flash" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_newsflash_form" id="add_newsflash_form">
                        <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                        <div class="field">
                            <label for="msg_name">News Title:</label>
                            <input type="text" id="msg_name" name="msg_name" placeholder="News Title" class="" autocomplete="on" value="<?php echo escaper ( Input::get('msg_name') ); ?>" />
                        </div>
                        <div class="field">
                            <label for="message_desc">New Flash Description:</label>
                            <textarea id="message_desc" name="message_desc" placeholder="New Flash Description" class="addr_textarea"><?php echo escaper ( Input::get('message_desc') ); ?></textarea>
                        </div>
                        <input type="submit" value="Add News Flash" name="btnAddFlash" id="btnAddFlash" class="ui blue fluid button">
                        <div class="ui error message"></div>    
                        <hr class="divider">
                        <a href="./flash_msg.php" alt="Back to Flash Message Page." class="ui">Back to Flash Messages</a>        
                    </form>
                </div>
                <div class="ui five wide computer four wide tablet column"></div>
            </div>
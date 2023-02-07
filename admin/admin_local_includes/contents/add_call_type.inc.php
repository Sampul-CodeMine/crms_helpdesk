<div class="ui grid stackable padded">
        <div class="ui two wided compter column"></div>
        <div class="ui sixteen wide tablet twelve wide computer column">
            <div class="row">
                <?php 
                    if ( Input::exists() ) {
                        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
                            $validate = new Validate();
                            $validation = $validate->check($_POST, array(
                                'call_type'=>array(
                                    'required'=>true,
                                    'max'=>100,
                                    'min'=>2
                                ),
                                'sub_call_type'=>array(
                                    'required'=>true,
                                    'max'=>100,
                                    'min'=>2,
                                    'unique'=>'tab_call_type',
                                    'isValide_E_Code'=>true
                                )
                            ));
                            if($validation->passed()){
                                $call_type = new User();

                                try{
                                    $call_type->create('tab_call_type', array(
                                        'call_type'=>escaper(ucwords(Input::get('call_type'))),
                                        'sub_call_type'=>escaper(Input::get('sub_call_type')),
                                        'ct_status'=>1
                                    ));

                                    Session::flash('success', 'You have added a call type successfully. <a href="./call_type.php" title="View All Call Types">Call Types</a>');
                                    if(Session::exists('success')){
                                        echo '<div class="ui success floating message"><div class="header">Success!</div>' . Session::flash("success") . '</div>';
                                    }
                                    exit();
                                } catch(Exception $err){
                                    die($err->getMessage());
                                }
                            } else{
                ?>
                            <div class="ui floating error message">
                                <div class="header">Error!</div>
                <?php 
                    foreach($validation->errors() as $error){
                        echo $error . "<br>";
                    }
                ?>
                            </div>
                <?php  
                            }
                        }
                    }
                ?>
                <p id="form-header" class="ui header huge">Add Call Types</p>
                <hr class="divider">
                <form class="ui form segment engr" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_call_types_form" id="add_call_types_form">
                    <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                    <div class="two fields">
                        <div class="field">
                            <label for="call_type">Call type:</label>
                            <input type="text" id="call_type" name="call_type" placeholder="Call Type" class="" value="<?php echo escaper(Input::get('call_type')); ?>" />
                        </div>
                        <div class="field">
                            <label for="sub_call_type">Sub Call Type:</label>
                            <input type="text" id="sub_call_type" name="sub_call_type" placeholder="Sub Call Type" class="" 
                            value="<?php echo escaper(Input::get('sub_call_type')); ?>" />
                        </div>
                    </div>
                    <input type="submit" value="Add Call Type" name="btnAddCallType" id="btnAddCallType" class="ui blue huge button">
                    <div class="ui error message"></div>
                    <hr class="divider">
                    <a href="./call_type.php" alt="Back to Call Type Page." class="ui">Back to Call Type</a>
                </form>
            </div>
        </div>
        <div class="ui two wide computer column"></div>
    </div>
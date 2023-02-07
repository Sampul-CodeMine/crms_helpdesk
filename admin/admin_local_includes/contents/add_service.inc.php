    <div class="ui grid stackable padded">
        <div class="ui two wided compter column"></div>
        <div class="ui sixteen wide tablet twelve wide computer column">
            <div class="row">
                <?php 
                    if ( Input::exists() ) {
                        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
                            $validate = new Validate();
                            $validation = $validate->check($_POST, array(
                                'service_code_name'=>array(
                                    'required'=>true,
                                    'max'=>32,
                                    'min'=>2
                                ),
                                'service_code'=>array(
                                    'required'=>true,
                                    'max'=>6,
                                    'min'=>6,
                                    'unique'=>'tab_service_code',
                                    'isValide_E_Code'=>true
                                )
                            ));
                            if($validation->passed()){
                                $service_code = new User();

                                try{
                                    $service_code->create('tab_service_code', array(
                                        'service_code_name'=>escaper(ucwords(Input::get('service_code_name'))),
                                        'service_code'=>escaper(strtoupper(Input::get('service_code'))),
                                        'service_code_status'=>1
                                    ));

                                    Session::flash('success', 'You have added a new service successfully. <a href="./services.php" title="View All Services">Service Codes</a>');
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
                <p id="form-header" class="ui header huge">Add Services</p>
                <hr class="divider">
                <form class="ui form segment engr" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="add_services_form" id="add_services_form">
                    <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
                    <div class="two fields">
                        <div class="field">
                            <label for="service_code_name">Service Name:</label>
                            <input type="text" id="service_code_name" name="service_code_name" placeholder="Service's Name" class="" value="<?php echo escaper(Input::get('service_code_name')); ?>" />
                        </div>
                        <div class="field">
                            <label for="service_code">Service Code:</label>
                            <input type="text" readonly id="service_code" name="service_code" placeholder="000-000" class="" 
                            value="<?php $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
                            echo $code; ?>" />
                        </div>
                    </div>
                    <input type="submit" value="Add Service" name="btnAddService" id="btnAddService" class="ui blue huge button">
                    <div class="ui error message"></div>
                    <hr class="divider">
                    <a href="./services.php" alt="Back to Service's Page." class="ui">Back to Services</a>
                </form>
            </div>
        </div>
        <div class="ui two wide computer column"></div>
    </div>
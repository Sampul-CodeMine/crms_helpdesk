<?php
    define('PAGE_TITLE', 'Login');
    define('HEADER', TRUE);
    include_once './local_includes/overall/login_header.php';
    define('ACCESS_NAV', TRUE);
    include_once './local_includes/featured/navigator.php';

    $user = new User();
    if ($user->isLoggedIn()){
        Redirect::to('./index.php');
        exit();
    }

?>
    <!--    Login form starts here-->
    <div class="holder">
<?php

    $err_msg = "";
    if ( Input::exists() ) {
        if ( Token::check ( Input::get ( 'auth_session' ) ) ) {
            $validate   = new Validate();
            $validation = $validate->check( $_POST, array(
                'login_username'        => array(
                    'required'  => true,
                    'max'       => 20,
                    'min'       => 5
                ),
                'login_password'        => array(
                    'required'  => true,
                    'max'       => 32,
                    'min'       => 6,
                )
            ));

            if ( $validation->passed() ) {
                $user_login       = new User();
                # log user in

                $username   = strtoupper( Input::get ( 'login_username' ) );
                $login      = $user_login->login ( 'tab_users', $username, Input::get ( 'login_password' ));

                if ( $login ) {
                    Session::flash( 'success', 'Welcome ' . $username . '!!! You logged in successfully.');
                    Redirect::to ( './index.php' );
                    exit();
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
if ( Session::exists ( 'error' ) ) :?>
        <div class="ui floating error message">
            <div class="header">Error!</div><?php echo Session::flash('error'); ?>
        </div>
<?php endif;
if ( Session::exists ( 'success' ) ) :?>
        <div class="ui floating success message">
            <div class="header">Success!</div><?php echo Session::flash('success'); ?>
        </div>
<?php endif; ?>
    <p id="form-header" class="ui header huge center aligned">User Login Page</p>
       <hr class="divider">
       <form class="ui form login" role="form" method="post" action="<?php echo escaper($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off" id="login_form" id="login_form">
          <input type="hidden" name="auth_session" id="auth_session" value="<?php echo Token::generate(); ?>" />
          <div class="field">
              <label for="login_username">Username:</label><br/>
              <input type="text" id="login_username" name="login_username" placeholder="Enter Username" class="" value="<?php echo escaper ( Input::get('login_username') ); ?>" />
          </div>
          <div class="field">
              <label for="login_password">Password:</label><br/>
              <input type="password" id="login_password" name="login_password" placeholder="Enter Password" class="" />
          </div>
          <input type="submit" value="Login" name="btnLogin" id="btnLogin" class="ui blue fluid button">
           <hr class="divider">
          <a href="./forget_password.php" alt="Click here to reset password." class="ui">Forgot Password</a>
          <div class="ui error message">
          </div>
      </form>
    </div>
    <!--    Login form ends here-->

<?php
    define('FOOTER', TRUE);
    include_once './local_includes/overall/login_footer.php';
?>

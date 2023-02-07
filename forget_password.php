<!DOCTYPE html>
<?php 
    define('PAGE_TITLE', 'Reset Password');
    require_once './admin/includes/core/init.php';
?>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./admin/assets/css/semantic.min.css" />
    <link rel="stylesheet" href="./admin/assets/css/font-awesome_all.min.css" />
    <link rel="stylesheet" href="./admin/assets/css/main.css" />
    <title><?php echo escaper(COMPANY . " | " . PROJECT . " | " . PAGE_TITLE); ?></title>
</head>
<body>
  
    <!-- Top Menu Start -->
    <nav class="ui top fixed inverted menu">
        <div class="left menu">
            <a href="" class="header item">CRM App</a>
        </div>    
    </nav>
    <!-- Top Menu Stop -->
    
    <!--    Login form starts here-->
    <div class="holder">
    <p id="form-header" class="ui header huge center aligned">Reset Password</p>
       <hr class="divider">
       <form class="ui form" role="form" method="post" action="#" autocomplete="off" id="login_form" id="login_form">
          <div class="field">
              <label for="login_username">Username:</label><br/>
              <input type="text" id="login_username" name="login_username" placeholder="Enter Username" class="" />
          </div>
          <input type="submit" value="Reset Password" name="btnReset" id="btnReset" class="ui red fluid button">
          <div class="ui error message"></div>
           <hr class="divider">
          <a href="./login.php" class="ui">Back to Login</a>
            
      </form>
    </div>
    <!--    Login form ends here-->
    
    <!--    Include the javascript files for this project-->
    <div>
        <script src="./admin/assets/js/jquery.min.js"></script>
        <script src="./admin/assets/js/semantic.min.js"></script>
        <script src="./admin/assets/js/scripter.js"></script>
    </div>
<!--    End of including Javascript for this project-->
</body>
</html>
<?php if( defined('ACCESS_TOP_NAV')) :?>
    <!-- top nav starts-->
    <nav class="ui top fixed inverted menu">
      <div class="left menu">
        <a href="#" class="sidebar-menu-toggler item" data-target="#sidebar">
          <i class="sidebar icon"></i>
        </a>
        <a href="./index.php" class="header item"><i class="ui home icon"></i> CRMS Mgmt</a>
      </div>
      <div class="center menu moving-msg">
<?php
    $moving_msg = "";
    $message = DB::getInstance()->get('tab_moving_msgs', array('status', '=', '1'));
    if ( $message->count()) {
        foreach ( $message->results() as $count => $msg ) {
            $moving_msg .= ($count + 1) . ' - ' . $msg->message . " ";
        }
    } else {
        $moving_msg = " Flash Message coming soon,";
    }
?>
          <marquee behavior="scroll" direction="left" scrollamount="3"><i style="color: #2185d0;">News Flash: </i> <?php echo escaper($moving_msg);?></marquee>
      </div>
      <div class="right menu">
        <div class="ui dropdown item">
          <i class="user cirlce icon"></i> <?php $user = new User(); echo $user->data()->user_username; ?>
          <div class="menu">
            <a href="#" class="item"><i class="info circle icon"></i> Profile</a>
            <a href="../logout.php" class="item"><i class="sign-out icon"></i>Logout</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- top nav ends-->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>

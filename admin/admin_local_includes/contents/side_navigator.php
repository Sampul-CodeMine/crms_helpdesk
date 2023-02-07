<?php if(defined('ACCESS_NAV')): ?>
    <!-- sidebar navigation starts-->
    <div class="ui sidebar inverted vertical menu sidebar-menu" id="sidebar">
     <div class="item"></div>
      <div class="item">
        <div class="header"><i class="tasks icon"></i> Quick Tasks</div>
        <div class="menu">
          <a class="item" href="./companies.php">
            <div>
              <i class="ticket icon"></i> New Company
            </div>
          </a>
          <a class="item">
            <div>
              <i class="credit card icon"></i> New Terminal / ATM
            </div>
          </a>
          <a class="item" href="./banks.php">
            <div>
              <i class="server icon"></i> New Bank
            </div>
          </a>
          <a class="item">
            <div>
              <i class="fork icon"></i> New Branch
            </div>
          </a>
        </div>
      </div>
      <div class="item">
        <div class="header"><a href="./admincp.php" title="Go to the administrator's control panel."><i class="configure icon"></i> Administration</a></div>
        <div class="menu">
          <a class="item" href="./users.php" title="Go to the User Management Page">
            <div><i class="users icon"></i>User Management</div>
          </a>
          <a class="item" href="./engineers.php" title="Go to the Engineer Management Page">
            <div><i class="users icon"></i>Engineer Management</div>
          </a>
          <a class="item" href="./vendors.php" title="Go to the Vendor Management Page">
            <div><i class="users icon"></i>Vendor Management</div>
          </a>
          <hr>
          <a class="item" href="./flash_msg.php" title="Manage Site's Flash Messages">
            <div><i class="calendar alternate icon"></i>Messages</div>
          </a>
        </div>
      </div>
      <a href="#" class="item">
        <div>
          <i class="icon chart line"></i>
          Charts
        </div>
      </a>
      <div class="item">
       <div class="header"> <i class="find icon"></i> Search</div>
        <form action="#">
          <div class="ui mini action input">
            <input type="text" placeholder="Search..." />
            <button class="ui mini icon button">
              <i class="search icon"></i>
            </button>
          </div>
        </form>
      </div>
      <div class="ui segment inverted">
        <div class="header"> <i class="database icon"></i> Server Usage</div>
        <div class="ui tiny olive inverted progress">
          <div class="bar" style="width: 54%"></div>
          <div class="label">Monthly Bandwidth</div>
        </div>

        <div class="ui tiny teal inverted progress">
          <div class="bar" style="width:78%"></div>
          <div class="label">Disk Usage</div>
        </div>
      </div>
    </div>
    <!-- sidebar navigation ends-->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>

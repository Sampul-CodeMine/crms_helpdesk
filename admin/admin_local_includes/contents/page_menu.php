<?php if(defined('PAGE_MENU')):?>
            <!--Page Menu starts -->
            <nav class="ui fluid inverted menu page_menu">
                <div class="right menu">
                    <a href="#" class="item">Request</a>
                    <a href="#" class="item">Bank</a>
                    <a href="#" class="item">ATM</a>
                    <a href="#" class="item">Reports</a>
                    <a href="./admincp.php" class="item" title="Go to the administrator's control panel.">Admin</a>
                </div>
            </nav>
            <!--Page Menu stop -->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>

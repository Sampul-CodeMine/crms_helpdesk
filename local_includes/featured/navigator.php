<?php if(defined('ACCESS_NAV')): ?>
        <!-- Top Menu Start -->
    <nav class="ui top fixed inverted menu">
        <div class="left menu">
            <a href="./index.php" class="header item">PMSL I-Mgmt</a>
        </div>    
    </nav>
    <!-- Top Menu Stop -->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
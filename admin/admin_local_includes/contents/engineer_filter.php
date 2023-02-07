<?php 
    require_once '../../includes/core/init.php';
    include_once ADMIN_PATH . 'includes/classes/DB.php';

    $db = new DB();
    $filtered_result = $db->engineer_filter($_POST['engineer']);
?>
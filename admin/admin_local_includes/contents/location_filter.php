<?php 
    require_once '../../includes/core/init.php';
    include_once ADMIN_PATH . 'includes/classes/DB.php';

    $db = new DB();
    $filtered_result = $db->location_filter($_POST['location']);
?>
<?php 
    require_once '../../includes/core/init.php';
    include_once ADMIN_PATH . 'includes/classes/DB.php';

    $db = new DB();
    $filtered_result = $db->service_code_filter($_POST['service_code']);
?>
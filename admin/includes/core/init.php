<?php
    session_start();
    //error_reporting(0);

    # Define some global parameters
    define('COMPANY', 'Sampul-CM');
    define('YEAR', date('Y'));
    define('PROJECT', 'CRMS');

    define( 'DIR', $_SERVER['DOCUMENT_ROOT']);
    define('HOME', DIR . '/crms_helpdesk');
    $admin_path = '/admin/';
    define('ADMIN_PATH', HOME . $admin_path);   

    $GLOBALS['config'] = array (
            'mysql'     => array (
            'host'      => '127.0.0.1',
            'username'  => 'root',
            'password'  => '',
            'dbname'    => 'cmrs_mgmt'
        ),
        'session'       => array (
            'session_name'  => 'user',
            'token_name'    => 'token'
        )
    );

    spl_autoload_register(function($class) {
        require_once ADMIN_PATH . 'includes/classes/' . $class . '.php';
    });

    include_once ADMIN_PATH . 'includes/functions/sanitize.php';
    
?>
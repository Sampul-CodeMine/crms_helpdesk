<?php if (defined('HEADER')) : ?>
<!DOCTYPE html>
<?php
    require_once './admin/includes/core/init.php';
?>
<?php ?>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./admin/uploads/pmsl.icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="./admin/assets/css/semantic.min.css" />
    <link rel="stylesheet" href="./admin/assets/css/font-awesome_all.min.css" />
    <link rel="stylesheet" href="./admin/assets/css/main.css" />
    <title><?php echo escaper(COMPANY . " | " . PROJECT . " | " . PAGE_TITLE); ?></title>
</head>
<body>
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
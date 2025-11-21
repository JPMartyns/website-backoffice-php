<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) and basename($_SERVER['PHP_SELF']) != 'index.php') {
    header("Location: index.php");
    exit;
}
    require_once "config.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=BASE_IMAGES_URL?>favicon.ico" type="ico">
    <?php 
        if(strpos($_SERVER['PHP_SELF'], BASE_ADMIN_URL . '/index.php') !== false or !isset($page_title)) {
            $seo_title =$site_title;
        } else {
            $seo_title = $page_title . " - " . $site_title;
        }
        ?>

    <title><?php echo $seo_title; ?></title>

    <!-- BOOTSTRAP-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- FANCYBOX -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <script src="<?=BASE_ADMIN_URL?>app-bo.js" defer></script>

    <!--NOSSO CSS-->

    <link rel="stylesheet" href="<?=BASE_URL?>styles.css">

</head>

<body>

    <header class="container d-lg-block">
        <div class="h-100 ">
            <div id="logo" class="col h-100">
                <a href="<?=BASE_ADMIN_URL?>"> <img src="<?=BASE_IMAGES_URL?>logo_bo.jpg" alt="logo"> </a>
            </div>
        </div>
    </header>

<?php
include "menu.php";
?>
<?php
$servername = "localhost";
$database =  "jm_photography";
$username = "user_jm";
$password = "Jm1234";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);
 
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$site_title = "Back Office - João Martins Photography";

//Define the base URL for the site
define("BASE_URL", "/site_jm_photography/");

// Define the base URL for the admin area
define("BASE_ADMIN_URL", BASE_URL . "bo/");

// Define the base URL for the images
define("BASE_IMAGES_URL", BASE_URL . "images/");


define("BASE_IMAGES_GALERIA_URL", dirname(__FILE__) . "/../images/galeria/");
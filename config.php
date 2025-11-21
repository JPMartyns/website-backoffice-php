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

$site_title = "João Martins Photography";
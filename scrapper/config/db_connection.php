<?php

// Database configuration

$db_host = 'localhost';

$db_user = 'revoycom_User25';

$db_pass = 'xHT8{3Yl]FkJ';

$db_name = 'revoycom_dbrevoy25';




// Create connection

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);



// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}



// Set charset to utf8mb4 for full Unicode support

$conn->set_charset("utf8mb4");

?>


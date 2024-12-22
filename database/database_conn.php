<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "meditrack";

// Establishing the mysqli connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

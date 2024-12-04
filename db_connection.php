<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root'; 
$db_db = 'idm232'; 

// Create the connection
$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

// Check the connection
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}
?>
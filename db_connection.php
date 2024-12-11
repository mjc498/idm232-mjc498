<?php
// $db_host = 'localhost';
// $db_user = 'root';
// $db_password = 'root'; 
// $db_db = 'idm232'; 

$db_host = 'localhost';
$db_user = 'mjc498';
$db_password = 'j1dAxlMUsGWUJz21'; 
$db_db = 'mjc498_db'; 

// CREATE CONNECTION
$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

// CHECK CONNECTION
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}
?> 
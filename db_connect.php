<?php
// Database connection details
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root'; // Use your MAMP MySQL password
$db_db = 'idm232'; // Use only the database name, not the table name

// Create the database connection
$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);
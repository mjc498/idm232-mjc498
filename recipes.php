<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "recipe_book";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for filters and search
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$cuisineFilter = isset($_GET['cuisine']) ? $_GET['cuisine'] : 'all';
$mealTypeFilter = isset($_GET['meal-type']) ? $_GET['meal-type'] : 'all';

// Base SQL query
$sql = "SELECT * FROM recipes WHERE 1=1";

// Add search condition if search query is provided
if (!empty($searchQuery)) {
    $sql .= " AND (title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
}

// Add cuisine filter if selected
if ($cuisineFilter !== 'all') {
    $sql .= " AND cuisine = '$cuisineFilter'";
}

// Add meal type filter if selected
if ($mealTypeFilter !== 'all') {
    $sql .= " AND meal_type = '$mealTypeFilter'";
}

// Execute the query
$result = $conn->query($sql);

?>

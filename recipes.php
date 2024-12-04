<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "final_recipes_list";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search and filter parameters
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$cuisineFilter = isset($_GET['cuisine']) ? $_GET['cuisine'] : 'all';

// Base SQL query
$sql = "SELECT * FROM recipes WHERE 1=1";

// Add search condition if search query is provided
if (!empty($searchQuery)) {
    $sql .= " AND (recipe_name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
}

// Add cuisine filter if selected
if ($cuisineFilter !== 'all') {
    $sql .= " AND cuisine = '$cuisineFilter'";
}

// Execute the query
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="recipes.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Recipe Book</h1>
        </div>
        <nav>
            <ul id="nav-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="help.html">Help</a></li>
            </ul>
        </nav>
    </header>

    <section class="recipe-listing">
        <h2>Recipes</h2>

        <form method="GET" action="recipes.php">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search for recipes..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit">Search</button>
            </div>

            <div class="filters">
                <label for="cuisine">Cuisine:</label>
                <select id="cuisine" name="cuisine">
                    <option value="all" <?php if ($cuisineFilter === 'all') echo 'selected'; ?>>All</option>
                    <option value="Italian" <?php if ($cuisineFilter === 'Italian') echo 'selected'; ?>>Italian</option>
                    <option value="Mexican" <?php if ($cuisineFilter === 'Mexican') echo 'selected'; ?>>Mexican</option>
                    <option value="Vegetarian" <?php if ($cuisineFilter === 'Vegetarian') echo 'selected'; ?>>Vegetarian</option>
                </select>
            </div>
        </form>

        <div class="recipe-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='recipe-card'>";
                    echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='Recipe Image'>";
                    echo "<h3>" . htmlspecialchars($row['recipe_name']) . "</h3>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<a href='recipe_detail.php?id=" . $row['id'] . "'>View Recipe</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No recipes found. Try adjusting your search or filters.</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <div class="footer-links">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="help.html">Help</a></li>
            </ul>
            <p>&copy; 2024 Recipe Book. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>

<?php
$conn->close();
?>
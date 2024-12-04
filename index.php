<?php
include 'db_connection.php';

// SQL 
$sql = "SELECT * FROM final_recipes_list WHERE 1=1";

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="recipes.css">
</head>
<body>

<!-- NAVIGATION -->
<header>
    <div class="logo">
        <h1>Recipe Book</h1>
    </div>
    <nav>
        <ul id="nav-list">
            <li><a href="index.html">Home</a></li>
            <li><a href="recipes.html">Recipes</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="help.html">Help</a></li>
        </ul>

        <!-- HAMBURGER -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</header>

<!-- HERO -->
<section class="hero">
    <div class="hero-text">
        <h2>Home</h2>
        <p>Discover Delicious Recipes</p>
    </div>
</section>

<!-- RECIPES -->
<section class="featured-recipes">
    <h2>Featured Recipes</h2>
    <div class="recipe-grid">
        <?php
        // Include the database connection
        include 'db_connect.php';

        // SQL query to fetch the first 3 recipes
        $query = "SELECT * FROM final_recipes_list LIMIT 3";
        $result = $mysqli->query($query);

        // Check if any recipes are returned
        if ($result && $result->num_rows > 0):
            while ($recipe = $result->fetch_assoc()):
        ?>
            <div class="recipe-card">
                <a href="recipe_detail.php?id=<?php echo htmlspecialchars($recipe['id']); ?>">
                    <img src="images/<?php echo htmlspecialchars($recipe['id']); ?>.jpg" alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
                    <h3><?php echo htmlspecialchars($recipe['recipe_name']); ?></h3>
                </a>
                <p><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe['cuisine']); ?></p>
                <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> mins</p>
                <p><strong>Servings:</strong> <?php echo htmlspecialchars($recipe['servings']); ?></p>
            </div>
        <?php
            endwhile;
        else:
        ?>
            <p>No recipes found.</p>
        <?php
        endif;

        // Close the database connection
        $mysqli->close();
        ?>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-links">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="recipes.html">Recipes</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="help.html">Help</a></li>
        </ul>
        <p>&copy; 2024 Recipe Book. All Rights Reserved.</p>
    </div>
</footer>

<!-- SCRIPT -->
<script>
    const hamburger = document.getElementById('hamburger');
    const navList = document.getElementById('nav-list');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navList.classList.toggle('active');
    });
</script>

</body>
</html>

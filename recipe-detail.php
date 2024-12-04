<?php
    // Example array of recipes
    $recipes = [
        ["name" => "Orange Chicken with Kale", "url" => "recipe-detail.php", "image" => "images/recipe-01.jpg"],
        ["name" => "Chicken Alfredo", "url" => "recipe-detail.php", "image" => "images/recipe-02.jpg"]
        // Add more recipes as needed
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Book - Recipes</title>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="help.php">Help</a></li>
        </ul>
    </nav>
</header>

<!-- RECIPES LIST -->
<section class="recipe-list">
    <h2>Our Recipes</h2>
    <div class="recipes">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-item">
                <a href="<?php echo $recipe['url']; ?>">
                    <img src="<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['name']; ?>">
                    <h3><?php echo $recipe['name']; ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-links">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="help.php">Help</a></li>
        </ul>
        <p>&copy; 2024 Recipe Book - Maria-Louisa Ching. All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>

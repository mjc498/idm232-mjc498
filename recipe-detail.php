<?php
include 'db_connection.php';

// Get the recipe ID from the URL
$recipeId = $_GET['id'] ?? '';

if (empty($recipeId)) {
    echo "Invalid Recipe ID.";
    exit;
}

// Fetch the recipe details from the database
$sql = "SELECT * FROM final_recipes_list WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Recipe not found.";
    exit;
}

$recipe = $result->fetch_assoc();
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['recipe_name']); ?> - Recipe Details</title>
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
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="help.html">Help</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="recipe-detail">
        <h2><?php echo htmlspecialchars($recipe['recipe_name']); ?></h2>
        <img 
            src="images/<?php echo htmlspecialchars($recipe['id']); ?>.jpg" 
            alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
        <p><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe['cuisine']); ?></p>
        <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> mins</p>
        <p><strong>Servings:</strong> <?php echo htmlspecialchars($recipe['servings']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($recipe['recipe_description']); ?></p>

        <h3>Ingredients</h3>
        <ul>
            <?php
            $ingredients = explode("\n", $recipe['ingredients']);
            foreach ($ingredients as $ingredient) {
                echo "<li>" . htmlspecialchars($ingredient) . "</li>";
            }
            ?>
        </ul>

        <h3>Instructions</h3>
        <ol>
            <?php
            $instructions = explode("\n", $recipe['instructions']);
            foreach ($instructions as $instruction) {
                echo "<li>" . htmlspecialchars($instruction) . "</li>";
            }
            ?>
        </ol>

        <a href="recipes.php" class="back-btn">Back to Recipes</a>
    </section>
</main>

<!-- FOOTER -->
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
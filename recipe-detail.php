<?php
include 'db_connection.php';

// URL RECIPE ID
$recipeId = $_GET['id'] ?? '';

if (empty($recipeId)) {
    echo "Invalid Recipe ID.";
    exit;
}

// RECIPE DETAILS FROM DB
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
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="case-study.html" target="_blank">Case Study</a></li>
        </ul>

<!-- HAMBURGER -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</header>

<main>
    <section class="recipe-detail">
        <h2><?php echo htmlspecialchars($recipe['recipe_name']); ?></h2>
        <div class="recipe-image">
            <img 
                src="images/<?php echo htmlspecialchars($recipe['id']); ?>.jpg" 
                alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
        </div>

<!-- DESCRIPTION -->
        <div class="description-section">
            <h3>Description</h3>
            <p><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
        </div>

<!-- INGREDIENTS -->
        <div class="ingredients-section">
            <h3>Ingredients</h3>
            <ul>
                <?php
                $ingredients = explode("\n", $recipe['ingredients']);
                foreach ($ingredients as $ingredient) {
                    $cleanedIngredient = str_replace(',', '', $ingredient);
                    echo '<li><input type="checkbox"> ' . htmlspecialchars($cleanedIngredient) . '</li>';
                }
                ?>
            </ul>
        </div>

<!-- STEPS -->
        <div class="steps-section">
            <h3>Instructions</h3>
            <div>
                <?php
                $steps = $recipe['steps'] ?? '';
                if (!empty($steps)) {
                    $stepsArray = explode("\n", $steps);
                    foreach ($stepsArray as $step) {
                        echo '<p>' . htmlspecialchars($step) . '</p>';
                    }
                } else {
                    echo '<p>No steps available for this recipe.</p>';
                }
                ?>
            </div>
        </div>

    </section>
</main>

<!-- FOOTER -->
<footer>
    <div class="footer-links">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="case-study.html" target="_blank">Case Study</a></li>
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

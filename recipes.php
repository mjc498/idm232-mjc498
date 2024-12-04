<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
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

    <section class="recipe-listing">
        <h2>Recipes</h2>

<!-- GRID -->
        <div class="recipe-grid">
            <?php if (!empty($filteredRecipes)): ?>
                <?php foreach ($filteredRecipes as $recipe): ?>
                    <div class="recipe-card">
                        <h3><?php echo htmlspecialchars($recipe[0]); // Recipe name ?></h3>
                        <p><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe[0]); // Cuisine ?></p>
                        <p><strong>Protein:</strong> <?php echo htmlspecialchars($recipe[1]); // Protein ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($recipe[2]); // Description ?></p>
                        <a href="recipe_detail.php?id=<?php echo urlencode($recipe[0]); ?>">View Recipe</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No recipes match your filters.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>

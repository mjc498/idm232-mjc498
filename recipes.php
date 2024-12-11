<?php
include 'db_connection.php';

// SQL 
$sql = "SELECT * FROM final_recipes_list WHERE 1=1";

// FILTERS
$searchQuery = $_GET['search'] ?? '';
$cuisineFilter = $_GET['cuisine'] ?? 'all';
$typeFilter = $_GET['type'] ?? 'all';

if (!empty($searchQuery)) {
    $sql .= " AND recipe_name LIKE '%" . $mysqli->real_escape_string($searchQuery) . "%'";
}
if ($cuisineFilter !== 'all') {
    $sql .= " AND cuisine = '" . $mysqli->real_escape_string($cuisineFilter) . "'";
}
if ($typeFilter !== 'all') {
    $sql .= " AND protein = '" . $mysqli->real_escape_string($typeFilter) . "'";
}

// DEFAULT
$sql .= " LIMIT 40";
$result = $mysqli->query($sql);

// RECIPES
$recipes = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
}
$mysqli->close();
?>

<!-- HTML -->
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
        <section class="recipe-listing">
            <h2>Recipes</h2>

<!-- SEARCH -->
            <form method="GET" action="recipes.php">
                <div class="search-bar">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search for recipes..." 
                        value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit">Search</button>
                </div>

<!-- FILTERS -->
                <div class="filters">
                    <label for="cuisine">Cuisine:</label>
                    <select id="cuisine" name="cuisine">
                        <option value="all" <?php echo $cuisineFilter === 'all' ? 'selected' : ''; ?>>All</option>
                        <option value="mexican" <?php echo $cuisineFilter === 'mexican' ? 'selected' : ''; ?>>Mexican</option>
                        <option value="french" <?php echo $cuisineFilter === 'french' ? 'selected' : ''; ?>>French</option>
                        <option value="italian" <?php echo $cuisineFilter === 'italian' ? 'selected' : ''; ?>>Italian</option>
                        <option value="american" <?php echo $cuisineFilter === 'american' ? 'selected' : ''; ?>>American</option>
                        <option value="asian" <?php echo $cuisineFilter === 'asian' ? 'selected' : ''; ?>>Asian</option>
                        <option value="middle-eastern" <?php echo $cuisineFilter === 'middle-eastern' ? 'selected' : ''; ?>>Middle Eastern</option>
                        <option value="mediterranean" <?php echo $cuisineFilter === 'mediterranean' ? 'selected' : ''; ?>>Mediterranean</option>
                        <option value="indian" <?php echo $cuisineFilter === 'indian' ? 'selected' : ''; ?>>Indian</option>
                        <option value="korean" <?php echo $cuisineFilter === 'korean' ? 'selected' : ''; ?>>Korean</option>
                        <option value="thai" <?php echo $cuisineFilter === 'thai' ? 'selected' : ''; ?>>Thai</option>
                    </select>

                    <label for="type">Protein:</label>
                    <select id="type" name="type">
                        <option value="all" <?php echo $typeFilter === 'all' ? 'selected' : ''; ?>>All</option>
                        <option value="chicken" <?php echo $typeFilter === 'chicken' ? 'selected' : ''; ?>>Chicken</option>
                        <option value="beef" <?php echo $typeFilter === 'beef' ? 'selected' : ''; ?>>Beef</option>
                        <option value="vegetarian" <?php echo $typeFilter === 'vegetarian' ? 'selected' : ''; ?>>Vegetarian</option>
                        <option value="pasta" <?php echo $typeFilter === 'pasta' ? 'selected' : ''; ?>>Pasta</option>
                        <option value="fish" <?php echo $typeFilter === 'fish' ? 'selected' : ''; ?>>Fish</option>
                        <option value="pork" <?php echo $typeFilter === 'pork' ? 'selected' : ''; ?>>Pork</option>
                        <option value="turkey" <?php echo $typeFilter === 'turkey' ? 'selected' : ''; ?>>Turkey</option>
                    </select>
                    <button type="submit" class="apply-filters-btn">Apply Filters</button>
                </div>
            </form>

<!-- RECIPES -->
            <div class="recipe-grid">
                <?php if (!empty($recipes)): ?>
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="recipe-card">
                            <img 
                                src="images/<?php echo htmlspecialchars($recipe['id']); ?>.jpg" 
                                alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>" 
                                loading="lazy">
                            <h3><?php echo htmlspecialchars($recipe['recipe_name']); ?></h3>
                            <p><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe['cuisine']); ?></p>
                            <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> mins</p>
                            <p><strong>Servings:</strong> <?php echo htmlspecialchars($recipe['servings']); ?></p>
                            <p><?php echo htmlspecialchars($recipe['recipe_subtitle']); ?></p>
                            <a class="view-recipe-link" href="recipe-detail.php?id=<?php echo htmlspecialchars($recipe['id']); ?>">View Recipe</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No recipes match your filters.</p>
                <?php endif; ?>
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

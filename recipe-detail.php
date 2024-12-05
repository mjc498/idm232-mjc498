<?php
include 'db_connection.php';

// SQL 
$sql = "SELECT * FROM final_recipes_list WHERE 1=1";

$mysqli->close();
?>

<?php
include 'db_connect.php';

// Get the recipe ID from the query parameter
$recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the recipe details from the database
$query = "SELECT * FROM final_recipes_list WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

// Check if the recipe exists
if (!$recipe) {
    echo "<p>Recipe not found.</p>";
    exit;
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['recipe_name']); ?></title>
    <link rel="stylesheet" href="recipes.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($recipe['recipe_name']); ?></h1>
    </header>
    <main>
        <div class="recipe-detail">
            <img src="images/<?php echo htmlspecialchars($recipe['image_url']); ?>" 
                 alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
            <p><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe['cuisine']); ?></p>
            <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> mins</p>
            <p><strong>Servings:</strong> <?php echo htmlspecialchars($recipe['servings']); ?></p>
            <p><strong>Instructions:</strong> <?php echo htmlspecialchars($recipe['instructions']); ?></p>
        </div>
    </main>
</body>
</html>

<?php
include("head.php");

if(isset($_GET['id'])) {
    $recipe_id = $_GET['id'];
    
    // Fetch recipe details by ID
    $recipeQuery = $pdo->prepare("SELECT * FROM recipes WHERE id = :recipe_id AND status <> 'rejected'");
    $recipeQuery->bindParam(':recipe_id', $recipe_id);
    $recipeQuery->execute();
    $recipeData = $recipeQuery->fetch(PDO::FETCH_ASSOC);

    if($recipeData) {
        // Proceed with displaying the update form
?>

<div class="container-fluid pt-4 px-4">
    <h3 class="text-center text-info text-uppercase">Update Recipe</h3>
    <div class="bg-light rounded h-100 p-4">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Recipe Name</label>
                <input type="text" class="form-control" name="recipe_name" value="<?php echo $recipeData['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Recipe Ingredients</label>
                <input type="text" class="form-control" name="recipe_ingredients" value="<?php echo $recipeData['ingredients']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Recipe Instructions</label>
                <textarea class="form-control" name="recipe_instructions"><?php echo $recipeData['instructions']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Recipe Category</label>
                <select class="form-select" name="recipe_category">
                    <?php
                    $query = $pdo->query("SELECT * FROM categories");
                    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $category) {
                        $selected = ($recipeData['category_id'] == $category['c_id']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $category['c_id'] ?>" <?php echo $selected ?>><?php echo $category['c_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Price</label>
                <input type="number" class="form-control" name="recipe_price" value="<?php echo $recipeData['price']; ?>">
            </div>
            <!-- Other form fields -->
            <button type="submit" class="btn btn-primary" name="update_recipe">Update Recipe</button>
        </form>
    </div>
</div>

<?php
    }
}

if(isset($_POST['update_recipe'])) {
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipe_name'];
    $recipe_ingredients = $_POST['recipe_ingredients'];
    $recipe_instructions = $_POST['recipe_instructions'];
    $price = $_POST['recipe_price'];
    $recipe_category = $_POST['recipe_category'];

    // Update recipe details in the database
    $updateQuery = $pdo->prepare("UPDATE recipes SET title = :title, ingredients = :ingredients, instructions = :instructions, price = :price, category_id = :category_id, status = 'Pending' WHERE id = :recipe_id");
    $updateQuery->bindParam(':title', $recipe_name);
    $updateQuery->bindParam(':ingredients', $recipe_ingredients);
    $updateQuery->bindParam(':instructions', $recipe_instructions);
    $updateQuery->bindParam(':price', $price);
    $updateQuery->bindParam(':category_id', $recipe_category);
    $updateQuery->bindParam(':recipe_id', $recipe_id);
    $updateQuery->execute();

    echo "<script>alert('Recipe updated successfully'); location.assign('chefboard.php');</script>";
}

include("foot.php");
?>

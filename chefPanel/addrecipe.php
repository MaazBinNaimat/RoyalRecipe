<?php
include("head.php");
?>

<div class="container-fluid pt-4 px-4">
    <h3 class="text-center text-uppercase" style="color:#c17d19;">Add Recipe</h3>
    <div class="bg-light rounded h-100 p-4">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Recipe Name</label>
                <input type="text" class="form-control" name="recipe_name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Recipe Ingredients</label>
                <input type="text" class="form-control" name="recipe_ingredients">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Recipe Instructions</label>
                <textarea class="form-control" name="recipe_instructions"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Recipe Category</label>
                <select class="form-select" name="recipe_category">
                    <?php
                    $query = $pdo->query("SELECT * FROM categories");
                    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?php echo $category['c_id'] ?>"><?php echo $category['c_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Prep Time (in minutes)</label>
                <input type="number" class="form-control" name="prep_time">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cook Time (in minutes)</label>
                <input type="number" class="form-control" name="cook_time">
            </div>
            <div class="mb-3">
                <label class="form-label">Payment Status</label>
                <select class="form-select" name="payment_status" id="payment_status">
                    <option value="free">Free</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
            <div class="mb-3" id="price_field" style="display: none;">
                <label for="exampleInputPassword1" class="form-label">Price</label>
                <input type="number" class="form-control" name="recipe_price">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
                <input type="file" class="form-control" name="recipe_image" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">upload PDF OR DOCX</label>
                <input type="file" class="form-control" name="rceipe_document">
            </div>
            <button type="submit" class="button-2" name="add_recipe">Add Recipe</button>
        </form>
    </div>
</div>

<script>
document.getElementById("payment_status").addEventListener("change", function() {
    var priceField = document.getElementById("price_field");
    if (this.value === "paid") {
        priceField.style.display = "block";
    } else {
        priceField.style.display = "none";
    }
});
</script>
<?php
if (isset($_POST['add_recipe'])) {
    $chef_id = $_SESSION['id'];
    $recipe_name = $_POST['recipe_name'];
    $recipe_ingredients = $_POST['recipe_ingredients'];
    $recipe_instructions = $_POST['recipe_instructions'];
    $recipe_category = $_POST['recipe_category'];
    $payment_status = $_POST['payment_status'];

    $prep_time = $_POST['prep_time'];
    $cook_time = $_POST['cook_time'];

    if ($payment_status === 'paid') {
        $recipe_price = $_POST['recipe_price'];
    } else {
        $recipe_price = "Free";
    }
// for image
    $recipe_img = $_FILES['recipe_image']['name'];
    $tmp_recipe_img = $_FILES['recipe_image']['tmp_name'];
    $extension = pathinfo($recipe_img, PATHINFO_EXTENSION);
    $destination = 'img/recipes/' . $recipe_img;
// for document
$recipeDocument = $_FILES['rceipe_document']['name'];
$recipeTmpDocument= $_FILES['rceipe_document']['tmp_name'];
$recipeDocumentSize= $_FILES['rceipe_document']['size'];
$recipeDocumentExtension = pathinfo($recipeDocument,PATHINFO_EXTENSION);
$recipeDocumentDestinition = "img/recipes/".$recipeDocument;
if($recipeDocumentSize>500000){
    echo "<script>alert('file is heavy')</script>";

}else{

    if (($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp") && ($recipeDocumentExtension == "pdf" || $recipeDocumentExtension == "docx")) {
        if ((move_uploaded_file($tmp_recipe_img, $destination)) && (move_uploaded_file($recipeTmpDocument, $recipeDocumentDestinition))) {
            $query = $pdo->prepare("INSERT INTO recipes (title, ingredients, instructions, category_id, chef_id, payment_status, price, prep_time, cook_time, image, document) VALUES (:title, :ingredients, :instructions, :category_id, :chef_id, :payment_status, :price, :prep_time, :cook_time, :image, :doc)");
            $query->bindParam(":title", $recipe_name);
            $query->bindParam(":ingredients", $recipe_ingredients);
            $query->bindParam(":instructions", $recipe_instructions);
            $query->bindParam(":category_id", $recipe_category);
            $query->bindParam(":chef_id", $chef_id);
            $query->bindParam(":payment_status", $payment_status);
            $query->bindParam(":price", $recipe_price);
            $query->bindParam(":prep_time", $prep_time);
            $query->bindParam(":cook_time", $cook_time);
            $query->bindParam(":image", $recipe_img);
            $query->bindParam(":doc", $recipeDocument);
            $query->execute();
            
            // Notification setup
            // Get the ID of the last inserted recipe
            $recipeId = $pdo->lastInsertId();
    
            // Notification setup
            $newRecipeName = $recipe_name; // Recipe name
            $timestamp = date('Y-m-d H:i:s'); // Current timestamp
            $notificationMessage = "(ID: $recipeId): $newRecipeName New recipe uploaded at $timestamp";
            $_SESSION['pending_notifications'][] = $notificationMessage;
            // Notification setup end
    
            echo "<script>alert('Recipe added successfully'); location.assign('chefboard.php');</script>";
        }
    }
    else {
        echo "<script>alert('Invalid image format.');</script>";
    }}

}

?>


<?php
include("foot.php");
?>

<?php
include("head.php");
if($_SESSION['uid']==1){

// Handle recipe approval
if (isset($_POST['approve'])) {
    $recipeId = $_POST['recipe_id'];
    // Update the recipe status to "Approved" in the database
    $updateQuery = $pdo->prepare("UPDATE recipes SET status = 'Approved' WHERE id = :recipe_id");
    $updateQuery->bindParam("recipe_id", $recipeId);
    $updateQuery->execute();
    echo "<script>alert('Recipe approved successfully');</script>";
}

// Handle recipe rejection
if (isset($_POST['reject'])) {
    $recipeId = $_POST['recipe_id'];
    // Update the recipe status to "Rejected" in the database
    $updateQuery = $pdo->prepare("UPDATE recipes SET status = 'Rejected' WHERE id = :recipe_id");
    $updateQuery->bindParam("recipe_id", $recipeId);
    $updateQuery->execute();
    echo "<script>alert('Recipe rejected successfully');</script>";
}

// Fetch recipes from the database
$query = $pdo->query("SELECT recipes.*, categories.c_name FROM recipes INNER JOIN categories ON recipes.category_id = categories.c_id");
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid pt-4 px-4 my-3">
    <div class="table-responsive">
        <table class="table table-light text-center">
            <thead>
            <tr>
                    <th class="py-3" scope="col">Id</th>
                    <th class="py-3" scope="col">Recipe Title</th>
                    <th class="py-3" scope="col">Category ID</th>
                    <th class="py-3" scope="col">Recipe Ingredients</th>
                    <th class="py-3" scope="col">Recipe Instructions</th>
                    <th class="py-3" scope="col">Recipe Prep Time</th>
                    <th class="py-3" scope="col">Recipe Cook Time</th>
                    <th class="py-3" scope="col">Payment Status</th>
                    <th class="py-3" scope="col">Price</th>
                    <th class="py-3" scope="col">Current Status</th>
                    <th class="py-3" scope="col">Image</th>
                    <th class="py-3" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $pdo->query("SELECT recipes.*, categories.c_name FROM recipes INNER JOIN categories ON recipes.category_id = categories.c_id");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $data) {
                ?>
                <tr class="">
                    <td><?php echo "#" . $data['id']; ?></td>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['category_id']; ?></td>
                    <td><?php echo $data['ingredients']; ?></td>
                    <td><?php echo $data['instructions']; ?></td>
                    <td><?php echo $data['prep_time']; ?></td>
                    <td><?php echo $data['cook_time']; ?></td>
                    <td><?php echo $data['payment_status']; ?></td>
                    <td><?php echo $data['price']; ?></td>
                    <td><?php echo $data['status']; ?></td>
                    <td>
                        <img src="../chefpanel/img/recipes/<?php echo $data['image']; ?>" width="100px">
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="recipe_id" value="<?php echo $data['id']; ?>">
                            <button class="btn btn-success" type="submit" name="approve">Approve</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="recipe_id" value="<?php echo $data['id']; ?>">
                            <button class="btn btn-warning my-2" type="submit" name="reject">Reject</button>
                        </form>
                        <form action="" method="get">
                            <button class="btn btn-danger">
                                <a href="?d_id=<?php echo $data['id']; ?>" class="text-dark">Delete</a>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php        
                }
                if (isset($_GET['d_id'])) {
                    $id = $_GET['d_id'];
                    $query = $pdo->prepare("DELETE from recipes where id = :pid");
                    $query->bindParam("pid", $id);
                    $query->execute();
                    echo "<script>
                       alert('Delete Recipe successfully');
                    </script>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
}
else{
    echo "<script>location.assign('../index.php')</script>";
}
?>
<?php
include("foot.php");
?>

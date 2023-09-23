<?php


include("head.php");

// Fetch chef's recipes from the database
$chefId = $_SESSION['id']; // Assuming you'll use sessions for authentication

$recipesQuery = $pdo->prepare("SELECT * FROM recipes WHERE chef_id = :id");
$recipesQuery->bindParam('id',$chefId);
$recipesQuery->execute();
$recipes = $recipesQuery->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container-fluid pt-4 px-4 my-3">
    <div class="table-responsive">
        
        
        <table class="table table-light text-center">
            <h4>All Recipes</h4>
            <thead>
                <tr>
                    <th class="py-3" scope="col">Recipe Id</th>
                    <th class="py-3" scope="col">Recipe Name</th>
                    <th class="py-3" scope="col">Recipe Ingredients</th>
                    <th class="py-3" scope="col">Recipe Category</th>
                    <th class="py-3" scope="col">Payment Status</th>
                    <th class="py-3" scope="col">Status</th>
                    <th class="py-3" scope="col">Price</th>
                    <th class="py-3" scope="col">image</th>
                    <th class="py-3" scope="col">documentation</th>
                    <th class="py-3" scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recipes as $data) { ?>
                    <tr class="">
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['title']; ?></td>
                        <td><?php echo $data['ingredients']; ?></td>
                        <td><?php echo $data['category_id']; ?></td>
                        <td><?php echo $data['payment_status']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td><?php echo ($data['payment_status'] === 'paid') ? '$' . $data['price'] : ''; ?></td>
                        <td><img src="img/recipes/<?php echo $data['image']; ?>" width="100px"></td>
                        <td><a class="button-1" href="img/recipes/<?php echo $data['document']?>" download > <?php echo $data['title']?> </a></td>
                        <td colspan="2">
                            <form action="" method="get">
                                
                                    <a href="edit_recipe.php?id=<?php echo $data['id']; ?>" class="button-2">Update</a>
                                
                            </form>
                            <form action="" method="get">
                                
                                    <a href="?d_id=<?php echo $data['id']; ?>" class="button-4 mt-1">Delete</a>
                                
                            </form>
                        </td>
                    </tr>
                <?php } 
                  if (isset($_GET['d_id'])) {
                    $id = $_GET['d_id'];
                    $query= $pdo->prepare("DELETE from recipes where id =:pid");
                        $query->bindParam("pid",$id);
                        $query->execute();
                        echo "<script>
                           alert('delete Recipe successfully');
                            location.assign('chefboard.php');
                            </script>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("foot.php");
?>

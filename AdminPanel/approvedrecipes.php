<?php
include('head.php');
if($_SESSION['uid']==1){
// Fetch approved recipes with chef details
$approvedRecipesQuery = $pdo->prepare("SELECT r.*, c.c_name, u.u_name, u.u_email FROM recipes r INNER JOIN categories c ON r.category_id = c.c_id INNER JOIN users u ON r.chef_id = u.u_id WHERE r.status = 'approved';
");
$approvedRecipesQuery->execute();
$approvedRecipes = $approvedRecipesQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row ">
    <div class="p-5 col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Approved Recipes</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Recipe Title</th>
                        <th scope="col">Ingredients</th>
                        <th scope="col">Instructions</th>
                        <th scope="col">Chef Name</th>
                        <th scope="col">Chef Email</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($approvedRecipes as $index => $recipe) { ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?php echo $recipe['title']; ?></td>
                            <td><?php echo $recipe['ingredients']; ?></td>
                            <td><?php echo $recipe['instructions']; ?></td>
                            <td><?php echo $recipe['u_name']; ?></td>
                            <td><?php echo $recipe['u_email']; ?></td>
                            <!-- Add more columns as needed -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}
else{
    echo "<script>location.assign('../index.php')</script>";
}
?>
<?php
include('foot.php');
?>

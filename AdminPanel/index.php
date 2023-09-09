<?php

include('head.php');
if($_SESSION['uid']==1){
    ?>
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x " style="color:#C19D60;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Recipes</p>
                                <h6 class="mb-0">
                                    <?php
                                    $query=$pdo->query("Select count(*)as total_recipes from recipes");
                                    $tr=$query->fetch(PDO::FETCH_ASSOC);



                                    echo $tr['total_recipes'];
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            
                            <i class="fa fa-user fa-3x " style="color:#C19D60;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Chefs</p>
                                <h6 class="mb-0">
                                <?php
                                    $query=$pdo->query("Select count(*)as total_chefs from users WHERE u_type_id = 2");
                                    $tc=$query->fetch(PDO::FETCH_ASSOC);



                                    echo $tc['total_chefs'];
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x " style="color:#C19D60;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0">
                                <?php
                                    $query=$pdo->query("Select count(*)as total_users from users WHERE u_type_id = 3");
                                    $tu=$query->fetch(PDO::FETCH_ASSOC);



                                    echo $tu['total_users'];
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
           <?php // Fetch approved recipes with chef details
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

            </div>
            <!-- Recent Sales End -->

            <?php
}
else{
    echo "<script>location.assign('../index.php')</script>";
}
?>


            <!-- Footer Start -->
            <?php
include('foot.php');
?>
            
<?php

include('head.php');
if($_SESSION['uid']==2){
    
    ?>
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4" id="btn-toggle1"
                class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse1" aria-expanded="false"
                aria-controls="Collapse1">
                <i class="fa fa-chart-bar fa-3x " style="color:#C19D60;"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Recipes</p>
                    <h6 class="mb-0">
                    <?php
$userId = $_SESSION['id']; // User ID from session

// Prepare the query
$query = $pdo->prepare("SELECT COUNT(*) AS total_recipes FROM recipes WHERE chef_id = :userId");

// Bind the parameter
$query->bindParam(':userId', $userId); 

// Execute the query
$query->execute();

// Fetch the result
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Total recipes count found
    echo  $result['total_recipes'];
    
} else {
    // Error handling if query fails
    echo "Error fetching total recipes count.";
}
?>

                    </h6>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4" id="btn-toggle2"
                class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse2" aria-expanded="false"
                aria-controls="Collapse2">

                <i class="fa fa-chart-bar fa-3x fa-beat-fade" style="color:#C19D60;"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Approved Recipes</p>
                    <h6 class="mb-0">
                        <?php
                                   $query=$pdo->prepare("SELECT count(*)as total_recipes from recipes where status = 'Approved' AND chef_id = :userId");
                                   // Bind the parameter
$query->bindParam(':userId', $userId); 

// Execute the query
$query->execute();




                                   $tr=$query->fetch(PDO::FETCH_ASSOC);



                                   echo $tr['total_recipes'];
                                    ?>
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4" id="btn-toggle3"
                class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse3" aria-expanded="false"
                aria-controls="Collapse3">
                <i class="fa fa-chart-bar fa-3x fa-beat-fade" style="color:#C19D60;"></i>
                <div class="ms-3">
                    <p class="mb-2">Pending Recipes</p>
                    <h6 class="mb-0">
                        <?php
                                    $query=$pdo->prepare("Select count(*)as total_recipes from recipes where status = 'Pending' And chef_id = :userId");
                                      // Bind the parameter
$query->bindParam(':userId', $userId); 

// Execute the query
$query->execute();

                                    $tr=$query->fetch(PDO::FETCH_ASSOC);



                                    echo $tr['total_recipes'];
                                    ?>
                    </h6>

                </div>

            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4" id="btn-toggle4"
                class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse4" aria-expanded="false"
                aria-controls="Collapse4">
                <i class="fa fa-chart-bar fa-3x fa-beat-fade" style="color:#C19D60;"></i>
                <div class="ms-3">
                    <p class="mb-2">Rejected Recipes</p>
                    <h6 class="mb-0">
                        <?php
                                    $query=$pdo->prepare("Select count(*)as total_recipes from recipes where status = 'Rejected' And chef_id = :userId");
                                      // Bind the parameter
$query->bindParam(':userId', $userId); 

// Execute the query
$query->execute();

                                    $tr=$query->fetch(PDO::FETCH_ASSOC);



                                    echo $tr['total_recipes'];
                                    ?>
                    </h6>

                </div>

            </div>
        </div>
        
       

        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4" id="btn-toggle5"
                class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#Collapse5" aria-expanded="false"
                aria-controls="Collapse5">
                <i class="fa fa-chart-bar fa-3x " style="color:#C19D60;"></i>
                <div class="ms-3">
                    <p class="mb-2">Download Recipes</p>
                    <h6 class="mb-0">
                    <?php
$query = $pdo->prepare("SELECT COUNT(*) as total_paid FROM downloadedrecipes WHERE chef_id = :userId");
$query->bindParam(':userId', $userId);

$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result !== false) {
    echo $result['total_paid'];
} else {
    echo "No paid recipes found for this chef.";
}
?>

                    </h6>
                </div>
            </div>
        </div>
        
    </div>

</div>
<!-- Sale & Revenue End -->



<div class="container-fluid pt-4 px-4">
    <div class="row ">



        <!-- filter data -->
        <!-- php -->
        
        <div class="container-fluid pt-4 px-4">

            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="Collapse1">
                    <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">All Recipes</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Recipe Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Chef Name</th>
                                        <th scope="col">Chef Email</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <?php 
$approvedRecipesQuery = $pdo->prepare("SELECT r.*, c.c_name, u.u_name, u.u_email FROM recipes r INNER JOIN categories c ON r.category_id = c.c_id INNER JOIN users u ON r.chef_id = u.u_id where chef_id = :userId;
");
// Bind the parameter
$approvedRecipesQuery->bindParam(':userId', $userId); 

// Execute the query
$approvedRecipesQuery->execute();
$approvedRecipes = $approvedRecipesQuery->fetchAll(PDO::FETCH_ASSOC);
?>
                                <tbody>
                                    <?php foreach ($approvedRecipes as $index => $recipe) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $index + 1; ?>
                                        </th>
                                        <td>
                                            <?php echo $recipe['title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['c_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_email']; ?>
                                        </td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="Collapse2">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Approved Recipes</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Recipe Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Chef Name</th>
                                        <th scope="col">Chef Email</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <?php 
$approvedRecipesQuery = $pdo->prepare("SELECT r.*, c.c_name, u.u_name, u.u_email FROM recipes r INNER JOIN categories c ON r.category_id = c.c_id INNER JOIN users u ON r.chef_id = u.u_id WHERE r.status = 'Approved' and chef_id = :userId;;
");
$approvedRecipesQuery->bindParam(':userId', $userId); 
$approvedRecipesQuery->execute();
$approvedRecipes = $approvedRecipesQuery->fetchAll(PDO::FETCH_ASSOC);
?>
                                <tbody>
                                    <?php foreach ($approvedRecipes as $index => $recipe) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $index + 1; ?>
                                        </th>
                                        <td>
                                            <?php echo $recipe['title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['c_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_email']; ?>
                                        </td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="Collapse3">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Panding Recipes</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Recipe Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Chef Name</th>
                                        <th scope="col">Chef Email</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <?php 
$approvedRecipesQuery = $pdo->prepare("SELECT r.*, c.c_name, u.u_name, u.u_email FROM recipes r INNER JOIN categories c ON r.category_id = c.c_id INNER JOIN users u ON r.chef_id = u.u_id WHERE r.status = 'Pending' and chef_id = :userId;
");
$approvedRecipesQuery->bindParam(':userId', $userId); 
$approvedRecipesQuery->execute();
$approvedRecipes = $approvedRecipesQuery->fetchAll(PDO::FETCH_ASSOC);
?>
                                <tbody>
                                    <?php foreach ($approvedRecipes as $index => $recipe) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $index + 1; ?>
                                        </th>
                                        <td>
                                            <?php echo $recipe['title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['c_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_email']; ?>
                                        </td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="Collapse4">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Rejected Recipes</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Recipe Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Chef Name</th>
                                        <th scope="col">Chef Email</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <?php 
$approvedRecipesQuery = $pdo->prepare("SELECT r.*, c.c_name, u.u_name, u.u_email FROM recipes r INNER JOIN categories c ON r.category_id = c.c_id INNER JOIN users u ON r.chef_id = u.u_id WHERE r.status = 'Rejected' and chef_id = :userId;
");
$approvedRecipesQuery->bindParam(':userId', $userId); 
$approvedRecipesQuery->execute();
$approvedRecipes = $approvedRecipesQuery->fetchAll(PDO::FETCH_ASSOC);
?>
                                <tbody>
                                    <?php foreach ($approvedRecipes as $index => $recipe) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $index + 1; ?>
                                        </th>
                                        <td>
                                            <?php echo $recipe['title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['c_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $recipe['u_email']; ?>
                                        </td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="Collapse5">
                    <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Download Paid Recipes</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">recipe</th>
                                        <th scope="col">chef</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Review</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <?php 
$totalChefQuery = $pdo->prepare("SELECT * from downloadedrecipes where chef_id = :userId");

$totalChefQuery->bindParam(':userId', $userId); 

$totalChefQuery->execute();
$totalchefs = $totalChefQuery->fetchAll(PDO::FETCH_ASSOC);
?>
                                <tbody>
                                    <?php foreach ($totalchefs as $index => $chefs) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $index + 1; ?>
                                        </th>
                                        <td>
                                            <?php echo $chefs['recipe_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $chefs['chef_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $chefs['downloading_date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $chefs['review']; ?>
                                        </td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Listen for click events on the first button
            $("#btn-toggle1").click(function () {
                // Toggle the collapse state of the first element
                $("#Collapse1").collapse("toggle");

                // Hide the second element if it's open
                $("#Collapse2").collapse("hide");
                $("#Collapse3").collapse("hide");
                $("#Collapse4").collapse("hide");
                $("#Collapse5").collapse("hide");
               
            });

            // Listen for click events on the second button
            $("#btn-toggle2").click(function () {
                // Toggle the collapse state of the second element
                $("#Collapse2").collapse("toggle");

                // Hide the first element if it's open
                $("#Collapse1").collapse("hide");
                $("#Collapse3").collapse("hide");
                $("#Collapse4").collapse("hide");
                $("#Collapse5").collapse("hide");
               
            });
            // Listen for click events on the second button
            $("#btn-toggle3").click(function () {
                // Toggle the collapse state of the second element
                $("#Collapse3").collapse("toggle");

                // Hide the first element if it's open
                $("#Collapse1").collapse("hide");
                $("#Collapse2").collapse("hide");
                $("#Collapse4").collapse("hide");
                $("#Collapse5").collapse("hide");
               
            });
            $("#btn-toggle4").click(function () {
                // Toggle the collapse state of the second element
                $("#Collapse4").collapse("toggle");

                // Hide the first element if it's open
                $("#Collapse1").collapse("hide");
                $("#Collapse2").collapse("hide");
                $("#Collapse3").collapse("hide");
                $("#Collapse5").collapse("hide");
               
            });
            $("#btn-toggle5").click(function () {
                // Toggle the collapse state of the second element
                $("#Collapse5").collapse("toggle");

                // Hide the first element if it's open
                $("#Collapse1").collapse("hide");
                $("#Collapse2").collapse("hide");
                $("#Collapse3").collapse("hide");
                $("#Collapse4").collapse("hide");
               
            });
            
        });
    </script>
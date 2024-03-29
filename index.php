<?php
include("session.php");

?>
<!DOCTYPE html>
<html lang="eng">

<!-- head tag -->
<?php
include('headtag.php');
if (!isset($_SESSION['uemail'])) {

?>
<body>

<?php
// Preloader
include('preloader.php');

// Progress scroll totop
include('scrolltotop.php');

// Navbar
include('navbar.php');
?>
<!-- Parallax Image -->
<div class="banner-header full-height valign bg-img bg-fixed" data-overlay-dark="7"
    data-background="img/daily/1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="v-middle">
                    <h5>Est. 2023</h5>
                    <h1>Welcome to Royal<span>Recipe Wordl!</span></h1>
                    <p>1616 boardbesn KHI, Karachi</p>
                    <a href="menubook.php" class="button-1 mt-30">Check Recipees<span></span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- arrow down -->
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
</div>
<!-- banner -->

<section class="about section-padding" data-scroll-index="1">
    <div class="container">
        <!-- Hero -->
        <div class="banner p-5 m-5 bg-light">
            <div class="row text-center">
                <div class="col-sm-5">
                            <?php
                            // Fetch the top recipe ID
                            $query = $pdo->prepare("SELECT recipe_id, COUNT(*) AS recipe_count
                                FROM downloadedrecipes
                                GROUP BY recipe_id
                                ORDER BY recipe_count DESC
                                LIMIT 1;");
                            $query->execute();
                            $topRecipe = $query->fetch(PDO::FETCH_ASSOC);

                            if ($topRecipe) {
                                // Top recipe exists, fetch its details
                                $recipeId = $topRecipe['recipe_id'];

                                $recipeDetailsQuery = $pdo->prepare("SELECT * FROM recipes WHERE id = :recipe_id");
                                $recipeDetailsQuery->bindValue(':recipe_id', $recipeId);
                                $recipeDetailsQuery->execute();
                                $recipeDetails = $recipeDetailsQuery->fetch(PDO::FETCH_ASSOC);

                                // Display top recipe details
                                if ($recipeDetails) {
                                    
                                    ?>
                                    <h1><?php echo $recipeDetails['title']; ?></h1>
                    
                    <p>This is our most downloaded recipe on the website! You can learn how to make this popular dish yourself. Give it a try and enjoy a delicious meal.</p>
                    </div>
                    <div class="col-sm-6"><?php
                    echo '<img src="chefPanel/img/recipes/' . $recipeDetails['image'] . '" alt="' . $recipeDetails['title'] . '" class="img-fluid w-50">';?>
                    <img class="img-fluid"   src="chefPanel/img/recipes/ <?php echo $recipeDetails['image'];?> " alt="">
                </div>
                    <?php
                                } else {
                                    echo '<p>No top recipe details available.</p>';
                                }
                            } else {
                                echo '<p>No top recipe found.</p>';
                            }
                            ?>
                        
                    </div>
            <!-- Hero -->
        </div>
    </div>
</section>
    
<!-- banner end -->
<!-- Chef -->
<!-- Top Recipe Section -->
<section class="about section-padding bg-blck">
    <div class="container">
        <div class="row">
            <div class="col-md-5 offset-md-1 mb-30">
                <?php
                // Fetch the chef's information whose recipes have been downloaded the most
                $query = $pdo->prepare('SELECT chef_id, COUNT(*) AS chef_count
                FROM downloadedrecipes
                GROUP BY chef_id
                ORDER BY chef_count DESC
                LIMIT 1');
                $query->execute();
                $topChef = $query->fetch(PDO::FETCH_ASSOC);

                if ($topChef) {
                     // Top chef exists, fetch its details
                     $chefId = $topChef['chef_id'];

                     $chefDetailsQuery = $pdo->prepare("SELECT * FROM users WHERE u_id = :chef_id");
                     $chefDetailsQuery->bindValue(':chef_id', $chefId);
                     $chefDetailsQuery->execute();
                     $chefDetails = $chefDetailsQuery->fetch(PDO::FETCH_ASSOC);

                     // Display top recipe details
                     if ($chefDetails) {
                        
                     

                ?>
                <img src="chefPanel/img/users/<?php echo $chefDetails['Profile_Picture']; ?>" alt="">
                <?php
                } else {
                ?>
                <!-- Default chef image or message if no chef is found -->
                <img src="img/chef/default-chef.jpg" alt="Chef Not Found">
                <?php
                }
            }
                ?>
            </div>
            <div class="col-md-5 valign mb-30">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-head mb-20">
                            <div class="section-subtitle">Discover Culinary Excellence</div>
                            <div class="section-title white">
                                <?php echo $chefDetails['u_name']; ?>
                            </div>
                        </div>
                        <?php
                        if ($chefDetails) {
                        ?>
                        <p>
                            <?php echo $chefDetails['u_name']; ?> is our top chef with the most downloaded recipes.
                            Chef <?php echo $chefDetails['u_name']; ?> has <?php echo $topChef['chef_count']; ?> recipes downloaded.
                            Chef <?php echo $chefDetails['u_name']; ?> welcomes you to explore their delicious creations.
                            ...
                        </p>
                        <div class="about-bottom">
                            <img src="img/signature.svg" alt="" class="image about-signature">
                            <div class="about-name-wrapper">
                                <div class="about-rol">
                                    <?php echo $chefDetails['u_name']; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        } else {
                            // If no chef is found, display a default message
                        ?>
                        <p>No top chef information available.</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Recipes -->
<section class="chef-recommends section-padding bg-cream">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-head text-center">
                <div class="section-subtitle">Should to Try</div>
                <div class="section-title">Top Recipes</div>
                <div class="section-backtitle">Top Recipes</div>
                <span class="icon">
                    <i class="flaticon-chef"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
    <?php
    // Fetch the top recipe ID
    $query = $pdo->prepare("SELECT recipe_id, COUNT(*) AS recipe_count
    FROM downloadedrecipes
    GROUP BY recipe_id
    ORDER BY recipe_count DESC
    LIMIT 3;");
    $query->execute();
    $topRecipes = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($topRecipes) {
        foreach ($topRecipes as $topRecipe) {
            // Top recipe exists, fetch its details
            $recipeId = $topRecipe['recipe_id'];

            $recipeDetailsQuery = $pdo->prepare("SELECT * FROM recipes WHERE id = :recipe_id");
            $recipeDetailsQuery->bindValue(':recipe_id', $recipeId);
            $recipeDetailsQuery->execute();
            $recipeDetails = $recipeDetailsQuery->fetch(PDO::FETCH_ASSOC);

            // Display top recipe details
            if ($recipeDetails) {
                ?>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="chefPanel/img/recipes/<?php echo $recipeDetails['image']?>" alt=""> </div>
                            <span class="category"><a href="#0"><?php echo $recipeDetails['price']; ?></a></span>
                            <div class="con">
                                <div class="icon flaticon-hamburger-1"></div>
                                <h6>Recipes</h6>
                                <h5><?php echo $recipeDetails['title']; ?></h5>
                                <div class="line"></div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="permalink"><?php echo $recipeDetails['category_id']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
            }
        }
    }
    ?>
    </div>
</div>
</section>


<!-- Services Box -->
<section class="services-box section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="item"> <span class="icon flaticon-cooking"></span>
                    <div class="cont">
                        <h5>Breakfast</h5>
                        <p>Breakfast ut nisl quam nestibulum drana odio elementum sceisue the can golden varius the
                            dis monte.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item"> <span class="icon flaticon-tray-2"></span>
                    <div class="cont">
                        <h5>Lunch</h5>
                        <p>The Lunch ut nisl quam nestibulum drana odio elementum sceisue the can golden varius the
                            dis monte.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item"> <span class="icon flaticon-chef-1"></span>
                    <div class="cont">
                        <h5>Dinner</h5>
                        <p>The Dinner ut nisl quam nestibulum drana odio elementum sceisue the can golden varius the
                            dis monte.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- First Class Services -->
<div class="first-class-services section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-head text-center">
                    <div class="section-subtitle">Firs-Class</div>
                    <div class="section-title white">Our Works</div>
                    <div class="section-backtitle">Services</div> <span class="icon white">
                        <i class="flaticon-tray-2"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-6">
                <div class="square-flip">
                    <div class="square bg-img" data-background="img/services/2.jpg">
                        <div class="square-container d-flex align-items-end justify-content-end">
                            <div class="box-title">
                                <div class="icon flaticon-food-serving"></div>
                                <h6>Address of Taste</h6>
                                <h4>Master Chef's Recipes</h4>
                            </div>
                        </div>
                        <div class="flip-overlay"></div>
                    </div>
                    <div class="square2">
                        <div class="square-container2">
                            <h6>Address of Taste</h6>
                            <h4>Master Chef's Recipes</h4>
                            <p><i>Lorem nisl miss nestibulum nec odio duru the aucan ula orci varius natoque enatau
                                    manis dis arturient monte miss morbine.</i></p>
                            <a href="menubook.php" class="button-4 mt-15">View Recipes<span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="square-flip">
                    <div class="square bg-img" data-background="img/services/3.jpg">
                        <div class="square-container d-flex align-items-end justify-content-end">
                            <div class="box-title">
                                <div class="icon flaticon-chef"></div>
                                <h6>Executive Chefs</h6>
                                <h4>Senior & Talented Chefs</h4>
                            </div>
                        </div>
                        <div class="flip-overlay"></div>
                    </div>
                    <div class="square2">
                        <div class="square-container2">
                            <h6>Executive Chefs</h6>
                            <h4>Senior & Talented Chefs</h4>
                            <p><i>Lorem nisl miss nestibulum nec odio duru the aucan ula orci varius natoque enatau
                                    manis dis arturient monte miss morbine.</i></p>
                            <a href="team.php" class="button-4 mt-15">Our Chefs<span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php

    

}else{
    $uid=$_SESSION['id'];
    $query=$pdo->prepare("select * from users where u_id=:pid");
    $query->bindParam("pid",$uid);
    $query->execute();
    ?>

<body>

    <?php
    // Preloader
    include('preloader.php');

    // Progress scroll totop
    include('scrolltotop.php');
    
    // Navbar
    include('navbar.php');
    ?>
    <!-- Parallax Image -->
    <div class="banner-header full-height valign bg-img bg-fixed" data-overlay-dark="7"
        data-background="img/daily/1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="v-middle">
                        <h5>Est. 2023</h5>
                        <h1>Welcome to Royal<span>Recipe Wordl!</span></h1>
                        <p>1616 boardbesn KHI, Karachi</p>
                        <a href="menubook.php" class="button-1 mt-30">Check Recipees<span></span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- arrow down -->
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>
    <!-- banner -->

    <section class="about section-padding" data-scroll-index="1">
        <div class="container">
            <!-- Hero -->
            <div class="banner p-5 m-5 bg-light">
                <div class="row text-center">
                    <div class="col-sm-5">
                                <?php
                                // Fetch the top recipe ID
                                $query = $pdo->prepare("SELECT recipe_id, COUNT(*) AS recipe_count
                                    FROM downloadedrecipes
                                    GROUP BY recipe_id
                                    ORDER BY recipe_count DESC
                                    LIMIT 1;");
                                $query->execute();
                                $topRecipe = $query->fetch(PDO::FETCH_ASSOC);

                                if ($topRecipe) {
                                    // Top recipe exists, fetch its details
                                    $recipeId = $topRecipe['recipe_id'];

                                    $recipeDetailsQuery = $pdo->prepare("SELECT * FROM recipes WHERE id = :recipe_id");
                                    $recipeDetailsQuery->bindValue(':recipe_id', $recipeId);
                                    $recipeDetailsQuery->execute();
                                    $recipeDetails = $recipeDetailsQuery->fetch(PDO::FETCH_ASSOC);

                                    // Display top recipe details
                                    if ($recipeDetails) {
                                        
                                        ?>
                                        <h1><?php echo $recipeDetails['title']; ?></h1>
                        
                        <p>This is our most downloaded recipe on the website! You can learn how to make this popular dish yourself. Give it a try and enjoy a delicious meal.</p>
                        </div>
                        <div class="col-sm-6"><?php
                        echo '<img src="chefPanel/img/recipes/' . $recipeDetails['image'] . '" alt="' . $recipeDetails['title'] . '" class="img-fluid w-50">';?>
                        <img class="img-fluid"   src="chefPanel/img/recipes/ <?php echo $recipeDetails['image'];?> " alt="">
                    </div>
                        <?php
                                    } else {
                                        echo '<p>No top recipe details available.</p>';
                                    }
                                } else {
                                    echo '<p>No top recipe found.</p>';
                                }
                                ?>
                            
                        </div>
                <!-- Hero -->
            </div>
        </div>
    </section>
        
    <!-- banner end -->
    <!-- Chef -->
    <!-- Top Recipe Section -->
    <section class="about section-padding bg-blck">
        <div class="container">
            <div class="row">
                <div class="col-md-5 offset-md-1 mb-30">
                    <?php
                    // Fetch the chef's information whose recipes have been downloaded the most
                    $query = $pdo->prepare('SELECT chef_id, COUNT(*) AS chef_count
                    FROM downloadedrecipes
                    GROUP BY chef_id
                    ORDER BY chef_count DESC
                    LIMIT 1');
                    $query->execute();
                    $topChef = $query->fetch(PDO::FETCH_ASSOC);

                    if ($topChef) {
                         // Top chef exists, fetch its details
                         $chefId = $topChef['chef_id'];

                         $chefDetailsQuery = $pdo->prepare("SELECT * FROM users WHERE u_id = :chef_id");
                         $chefDetailsQuery->bindValue(':chef_id', $chefId);
                         $chefDetailsQuery->execute();
                         $chefDetails = $chefDetailsQuery->fetch(PDO::FETCH_ASSOC);

                         // Display top recipe details
                         if ($chefDetails) {
                            
                         

                    ?>
                    <img src="chefPanel/img/users/<?php echo $chefDetails['Profile_Picture']; ?>" alt="">
                    <?php
                    } else {
                    ?>
                    <!-- Default chef image or message if no chef is found -->
                    <img src="img/chef/default-chef.jpg" alt="Chef Not Found">
                    <?php
                    }
                }
                    ?>
                </div>
                <div class="col-md-5 valign mb-30">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-head mb-20">
                                <div class="section-subtitle">Discover Culinary Excellence</div>
                                <div class="section-title white">
                                    <?php echo $chefDetails['u_name']; ?>
                                </div>
                            </div>
                            <?php
                            if ($chefDetails) {
                            ?>
                            <p>
                                <?php echo $chefDetails['u_name']; ?> is our top chef with the most downloaded recipes.
                                Chef <?php echo $chefDetails['u_name']; ?> has <?php echo $topChef['chef_count']; ?> recipes downloaded.
                                Chef <?php echo $chefDetails['u_name']; ?> welcomes you to explore their delicious creations.
                                ...
                            </p>
                            <div class="about-bottom">
                                <img src="img/signature.svg" alt="" class="image about-signature">
                                <div class="about-name-wrapper">
                                    <div class="about-rol">
                                        <?php echo $chefDetails['u_name']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            } else {
                                // If no chef is found, display a default message
                            ?>
                            <p>No top chef information available.</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Recipes -->
    <section class="chef-recommends section-padding bg-cream">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-head text-center">
                    <div class="section-subtitle">Should to Try</div>
                    <div class="section-title">Top Recipes</div>
                    <div class="section-backtitle">Top Recipes</div>
                    <span class="icon">
                        <i class="flaticon-chef"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
        <?php
        // Fetch the top recipe ID
        $query = $pdo->prepare("SELECT recipe_id, COUNT(*) AS recipe_count
        FROM downloadedrecipes
        GROUP BY recipe_id
        ORDER BY recipe_count DESC
        LIMIT 3;");
        $query->execute();
        $topRecipes = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($topRecipes) {
            foreach ($topRecipes as $topRecipe) {
                // Top recipe exists, fetch its details
                $recipeId = $topRecipe['recipe_id'];

                $recipeDetailsQuery = $pdo->prepare("SELECT * FROM recipes WHERE id = :recipe_id");
                $recipeDetailsQuery->bindValue(':recipe_id', $recipeId);
                $recipeDetailsQuery->execute();
                $recipeDetails = $recipeDetailsQuery->fetch(PDO::FETCH_ASSOC);

                // Display top recipe details
                if ($recipeDetails) {
                    ?>
                        <div class="col-md-4">
                            <div class="item">
                                <div class="position-re o-hidden"> <img src="chefPanel/img/recipes/<?php echo $recipeDetails['image']?>" alt=""> </div>
                                <span class="category"><a href="#0"><?php echo $recipeDetails['price']; ?></a></span>
                                <div class="con">
                                    <div class="icon flaticon-hamburger-1"></div>
                                    <h6>Recipes</h6>
                                    <h5><?php echo $recipeDetails['title']; ?></h5>
                                    <div class="line"></div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="permalink"><?php echo $recipeDetails['category_id']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }
        }
        ?>
        </div>
    </div>
</section>


    <!-- Services Box -->
    <section class="services-box section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="item"> <span class="icon flaticon-cooking"></span>
                        <div class="cont">
                            <h5>Breakfast</h5>
                            <p>Breakfast ut nisl quam nestibulum drana odio elementum sceisue the can golden varius the
                                dis monte.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item"> <span class="icon flaticon-tray-2"></span>
                        <div class="cont">
                            <h5>Lunch</h5>
                            <p>The Lunch ut nisl quam nestibulum drana odio elementum sceisue the can golden varius the
                                dis monte.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item"> <span class="icon flaticon-chef-1"></span>
                        <div class="cont">
                            <h5>Dinner</h5>
                            <p>The Dinner ut nisl quam nestibulum drana odio elementum sceisue the can golden varius the
                                dis monte.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- First Class Services -->
    <div class="first-class-services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-head text-center">
                        <div class="section-subtitle">Firs-Class</div>
                        <div class="section-title white">Our Works</div>
                        <div class="section-backtitle">Services</div> <span class="icon white">
                            <i class="flaticon-tray-2"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="square-flip">
                        <div class="square bg-img" data-background="img/services/2.jpg">
                            <div class="square-container d-flex align-items-end justify-content-end">
                                <div class="box-title">
                                    <div class="icon flaticon-food-serving"></div>
                                    <h6>Address of Taste</h6>
                                    <h4>Master Chef's Recipes</h4>
                                </div>
                            </div>
                            <div class="flip-overlay"></div>
                        </div>
                        <div class="square2">
                            <div class="square-container2">
                                <h6>Address of Taste</h6>
                                <h4>Master Chef's Recipes</h4>
                                <p><i>Lorem nisl miss nestibulum nec odio duru the aucan ula orci varius natoque enatau
                                        manis dis arturient monte miss morbine.</i></p>
                                <a href="menubook.php" class="button-4 mt-15">View Recipes<span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="square-flip">
                        <div class="square bg-img" data-background="img/services/3.jpg">
                            <div class="square-container d-flex align-items-end justify-content-end">
                                <div class="box-title">
                                    <div class="icon flaticon-chef"></div>
                                    <h6>Executive Chefs</h6>
                                    <h4>Senior & Talented Chefs</h4>
                                </div>
                            </div>
                            <div class="flip-overlay"></div>
                        </div>
                        <div class="square2">
                            <div class="square-container2">
                                <h6>Executive Chefs</h6>
                                <h4>Senior & Talented Chefs</h4>
                                <p><i>Lorem nisl miss nestibulum nec odio duru the aucan ula orci varius natoque enatau
                                        manis dis arturient monte miss morbine.</i></p>
                                <a href="team.php" class="button-4 mt-15">Our Chefs<span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Footer -->
    <?php
    }
    
    
    include('footer.php');
    // jQuery
    include('scriptlinks.php');
    ?>

</body>

</html>
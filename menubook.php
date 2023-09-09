<?php
include("session.php");

?>
<!DOCTYPE html>
<html lang="eng">

<!-- head tag -->
<?php
include('headtag.php');
if (!isset($_SESSION['uemail'])) {
echo"<script>
location.assign('login.php')
</script>";

}else{
    $uid=$_SESSION['id'];
    $query=$pdo->prepare("select * from users where u_id=:pid");
    $query->bindParam("pid",$uid);
    $query->execute();
    ?>

<body>
    <!-- Preloader -->
    <?php
    include('preloader.php');

    //  Progress scroll totop 
    include('scrolltotop.php');

    // Navbar
    include('navbar.php');
    ?>

    <!-- Header Banner -->
    <div class="banner-header valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/banner11.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption mt-60">
                    <h5>recipe world</h5>
                    <h1>Recipe Menu <span>Food & Food</span></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Book -->
    <section class="menu-book tabs section-padding position-re bg-blck">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="tab-links mb-60">
                        <?php
                        // Fetch categories from the database
                        $query = $pdo->query("SELECT c_id, c_name FROM categories");
                        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <ul class="text-center">
                            <?php foreach ($categories as $category) {
                                $categoryId = $category["c_id"];
                                $categoryName = $category["c_name"];
                                $isActive = ($categoryId === 1) ? "current" : ""; // Assuming the first category is initially active
                                ?>
                            <li class="item-link <?php echo $isActive; ?>" data-tab="tab-<?php echo $categoryId; ?>">
                                <?php echo $categoryName; ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="position-re">
                        <?php foreach ($categories as $category) : ?>
                        <div class="tab-content <?php echo ($category['c_id'] === 1) ? 'current' : ''; ?>"
                            id="tab-<?php echo $category['c_id']; ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                        $recipeQuery = $pdo->prepare('SELECT r.*, c.c_name FROM recipes r INNER JOIN categories c ON r.category_id = c.c_id WHERE c.c_id = :category_id AND r.status = "approved"');
                                        $recipeQuery->bindValue(':category_id', $category['c_id']);
                                        $recipeQuery->execute();
                                        $recipes = $recipeQuery->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($recipes as $recipe) {
                                            ?>
                                    <div class="menu-list mb-30">
                                        <div class="item">
                                            <div class="img">
                                                <a href="chefPanel/img/recipes/<?php echo $recipe['image']; ?>"
                                                    class="image-popup-vertical-fit" title="">
                                                    <img src="chefPanel/img/recipes/<?php echo $recipe['image']; ?>"
                                                        alt="" title="">
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="title">
                                                    <?php echo $recipe['title']; ?>
                                                </div>
                                                <div class="dots"></div>
                                                <div class="price">
                                                    <?php echo $recipe['payment_status']; ?>
                                                </div>
                                                <div class="dots"></div>

                                                <!-- Button trigger modal -->
                                                                                           <button  type="button" class="button-4" data-bs-toggle="modal"
                                                    data-bs-target="#recipeModal<?php echo $recipe['id']?>"
                                                    data-recipe-title="<?php echo $recipe['title']; ?>"
                                                    data-recipe-ingredients="<?php echo $recipe['ingredients']; ?>"
                                                    data-recipe-instructions="<?php echo $recipe['instructions']; ?>"
                                                    data-recipe-prep-time="<?php echo $recipe['prep_time']; ?>"
                                                    data-recipe-cook-time="<?php echo $recipe['cook_time']; ?>"
                                                    data-recipe-payment-status="<?php echo $recipe['payment_status']; ?>"
                                                    data-recipe-image="chefPanel/img/recipes/<?php echo $recipe['image']; ?>"
                                                    data-recipe-price="<?php echo $recipe['price']; ?>">
                                                    View Recipe
                                                </button>
                                                

                                            </div>
                                            <p><i>
                                                    <?php echo $recipe['ingredients']; ?>
                                                </i></p>
                                                
                                        </div>
                                    </div>
                                    <?php
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Modal -->
    
    <div class="modal fade" id="recipeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRecipeTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p><strong>Ingredients: </strong> <span id="modalRecipeIngredients"></span></p>
                            <p><strong>Instructions: </strong> <span id="modalRecipeInstructions"></span></p>
                            <p><strong>Prep Time: </strong> <span id="modalRecipePrepTime"></span></p>
                            <p><strong>Cook Time: </strong> <span id="modalRecipeCookTime"></span></p>
                            <p><strong>Payment Status: </strong> <span id="modalRecipePaymentStatus"></span></p>
                        </div>
                        <div class="col-lg-6">
                            <img src="" alt="" id="modalRecipeImage">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-dark">

                    <button type="button" class="button-4" data-bs-dismiss="modal">Close</button>
                    <?php if ($recipe['payment_status'] == "Paid") { ?>
                    <!-- Show the "Price" button for paid recipes -->
                    <button type="button" class="button-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
<span id="modalRecipePrice"></span></button>
                  <form action="" method="post">

                  <button class="btn btn-info"> review</button>
                  </form>
                    <?php } else if ($recipe['payment_status'] == "Free") { ?>
                    <!-- Show the "Download" button for free recipes -->
                    <button type="button" class="button-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Download</button>
                        <button type="button" class="button-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Review</button>
                    

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to populate modal content when the "View Recipe" button is clicked
        document.addEventListener('DOMContentLoaded', function () {
            var recipeModal = new bootstrap.Modal(document.getElementById('recipeModal'));

            document.querySelectorAll('.button-4').forEach(function (button) {
                button.addEventListener('click', function () {
                    document.getElementById('modalRecipeTitle').textContent = button.getAttribute('data-recipe-title');
                    document.getElementById('modalRecipeIngredients').textContent = button.getAttribute('data-recipe-ingredients');
                    document.getElementById('modalRecipeInstructions').textContent = button.getAttribute('data-recipe-instructions');
                    document.getElementById('modalRecipePrepTime').textContent = button.getAttribute('data-recipe-prep-time');
                    document.getElementById('modalRecipeCookTime').textContent = button.getAttribute('data-recipe-cook-time');
                    document.getElementById('modalRecipePaymentStatus').textContent = button.getAttribute('data-recipe-payment-status');
                    document.getElementById('modalRecipeImage').src = button.getAttribute('data-recipe-image');

                    // Populate the price based on the selected recipe
                    var priceElement = document.getElementById('modalRecipePrice');
                    var price = button.getAttribute('data-recipe-price');
                    if (priceElement && price) {
                        priceElement.textContent = price + " PKR";
                    }

                    recipeModal.show();
                });
            });
        });
    </script>

    <!-- Footer -->
    <?php
    include('footer.php');

    // jQuery
    include('scriptlinks.php');
    ?>
    <?php } ?>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recipe Download & Reviews</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Recipe download & review work on Pending 
      </div>
      
    </div>
  </div>
</div>
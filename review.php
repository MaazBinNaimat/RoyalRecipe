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
    <div class="banner-header valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/banner12.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption mt-60">
                    <h5>Latest News</h5>
                    <h1>User & Reviews<span>RoyalRecipe World</span></h1>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recipe Reviews  -->

<!-- Reviews -->
<section class="section-padding bg-blck">
    <div class="container">
        <div class="row text-center">
            <h1 style="color:#fff;">User Reviews</h1>
        </div>
        

<?php
// SQL query to fetch data with JOIN
$query = $pdo->prepare("SELECT recipes.title, users.u_name, downloadedrecipes.review, downloadedrecipes.downloading_date
FROM downloadedrecipes
INNER JOIN recipes ON recipes.id = recipes.id
INNER JOIN users ON users.u_id = users.u_id");
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
        <?php foreach ($rows as $index => $data): ?>
    

    
                        <div class="col-md-12">
                            <ul class="accordion-box clearfix">
                                
                                <li class="accordion block">
                                    <div class="acc-btn size-20"><?php  echo $data['title']; ?></div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">
                                            <h6 class="text-light"><?php  echo 'User Name: '. $data['u_name']; ?></h6>    
                                            <?php  echo $data['review']; ?></div>
                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                                    <?php endforeach; ?>
                    </div>           

    </div>
    </section>
    <!-- Footer -->
    <?php
    include('footer.php');

    // jQuery
    include('scriptlinks.php');
    ?>
    <?php } ?>
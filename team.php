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

    <?php
    // Preloader
    include('preloader.php');

    // Progress scroll totop
    include('scrolltotop.php');
    
    // Navbar
    include('navbar.php');
    ?>
    <!-- Header Banner -->
    <div class="banner-header valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/5.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption mt-60">
                    <h5>Our Experts</h5>
                    <h1>Meet Our Chefs <span>. . .</span></h1>
                </div>
            </div>
        </div>
    </div>
   <!-- Team -->
<section class="team section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php
                    // Fetch all chefs from the users table where user_type_id = 2
                    $query = $pdo->query('SELECT * FROM users WHERE u_type_id = 2');
                    $chefs = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($chefs as $chef) {
                        ?>
                        <div class="team-card mb-30">
                            <div class="team-img"><img src="chefPanel/img/users/<?php echo $chef['Profile_Picture']; ?>" alt="" class="w-100"></div>
                            <div class="team-content">
                                <h3 class="team-title"><?php echo $chef['u_name']; ?><span><?php echo $chef['phone_num']; ?></span></h3>
                                <p class="team-text"><strong>Address: </strong><?php echo $chef['address']; ?><br><strong>SpecialtyExpertise: </strong>
                                <?php echo $chef['SpecialtyExpertise']; ?></p>
                                
                            </div>
                            <div class="title-box">
                                <h3 class="mb-0"><?php echo $chef['u_name']; ?><span><?php echo $chef['phone_num']; ?></span></h3>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

   <!-- Chef -->
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
    <section class="chef-recommends section-padding bg-cream">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-head text-center">
                    <div class="section-subtitle">Should to Hire</div>
                    <div class="section-title">Top Chef</div>
                    <div class="section-backtitle">Top Chef</div>
                    <span class="icon">
                        <i class="flaticon-chef"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
        <?php
        // Fetch the top recipe ID
        $query = $pdo->prepare("SELECT chef_id, COUNT(*) AS chef_count
        FROM downloadedrecipes
        GROUP BY chef_id
        ORDER BY chef_count DESC
        LIMIT 3;");
        $query->execute();
        $topChefs = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($topChefs) {
            foreach ($topChefs as $topChef) {
                // Top recipe exists, fetch its details
                $chefId = $topChef['chef_id'];

                $chefDetailsQuery = $pdo->prepare("SELECT * FROM users WHERE u_id = :chef_id");
                $chefDetailsQuery->bindValue(':chef_id', $chefId);
                $chefDetailsQuery->execute();
                $chefDetails = $chefDetailsQuery->fetch(PDO::FETCH_ASSOC);

                // Display top recipe details
                if ($chefDetails) {
                    ?>
                        <div class="col-md-4">
                            <div class="item">
                                <div class="position-re o-hidden"> <img src="chefPanel/img/users/<?php echo $chefDetails['Profile_Picture']?>" alt=""> </div>
                                <span class="category"><a href="#"><?php echo $chefDetails['SpecialtyExpertise']; ?></a></span>
                                <div class="con">
                                    
                                    <h6>Chefs</h6>
                                    <h5><?php echo $chefDetails['u_name']; ?></h5>
                                    <div class="line"></div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="permalink"><?php echo 'Email: ' . $chefDetails['u_email'];?></div>
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

  
    <!-- Footer -->
    <?php
    
    
    
    include('footer.php');
    // jQuery
    include('scriptlinks.php');
    ?>
    <?php } ?>
    
</body>

<!-- Mirrored from duruthemes.com/demo/html/candore/demo1/team.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Jul 2023 12:47:08 GMT -->
</html>
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
include('headtag.php');
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
    <div class="banner-header valign bg-img bg-fixed" data-overlay-dark="6" data-background="img/slider/10.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption mt-60">
                    <h5>Who are we</h5>
                    <h1>About Us <span>Our History</span></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30">
                    <div class="section-head mb-20">
                        <div class="section-subtitle">Candóre Restaurant</div>
                        <div class="section-title">Few Words About Us</div>
                    </div>
                    <p>Restaurant vulputate massa sit amet ravida haretra nuam enim mi obortis eset uctus enec accumsan eu justo aliquam sit amet auctor orci donec vitae vehicula risus duise nunc sapien, accumsan id mauris ac ullamcorper rutrum asiquam congue nie ipsum auctor frinilla donec finibus sapien ut leo cursus ullamco.</p>
                    <p>Wine porta laoreet ante, luctus maximus ipsum blandit eget. Integer mollis eniman metus, eget consequat enim commodo eduis id magna arcu duis nec elit praesent convallis et justo nec tristique sapien quis.</p>
                    <!-- reservation -->
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-tray-1"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:855-100-4444">855 100 4444</a>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3"> <img src="img/about2.jpg" alt="" class="mt-90 mb-30"> </div>
                <div class="col col-md-3"> <img src="img/about.jpg" alt=""> </div>
            </div>
        </div>
    </section>
    
    
   <!-- Blog -->
   <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="chef-recommends-2 mb-90 animate-box" data-animate-effect="fadeInUp">
                        <figure><img src="img/news/s1.jpg" alt="" class="img-fluid"></figure>
                        <div class="caption">
                            <h3><a href="#0">Mains</a></h3>
                            <h4>New York Strip Steak with Garlic Butter</h4>
                            <p>Our restaurant, "ROYAL RECIPE," is not just a place to dine; it's a culinary experience designed to delight your senses. Nestled in the heart of the city, we take pride in offering a diverse and delectable menu that caters to every palate. Our journey began with a passion for creating memorable dining moments, and that passion continues to inspire our team of talented chefs who craft each dish with care and creativity.</p>
                            <hr class="border-2">
                            <div class="info-wrapper">
                                <div class="more"><a href="" class="link-btn blck" tabindex="0">Read More <i class="ti-arrow-right"></i></a></div>
                                <div class="icon ti-calendar"> 30 sep 2023</div>
                            </div>
                        </div>
                    </div>
                    <div class="chef-recommends-2 mb-90 left animate-box" data-animate-effect="fadeInUp">
                        <figure><img src="img/news/s2.jpg" alt="" class="img-fluid"></figure>
                        <div class="caption">
                            <h3><a href="#0">Salads</a></h3>
                            <h4>Grilled Salmon Salad With Lime and Herbs Recipe</h4>
                            <p>At "ROYAL RECIPE," we're not just a restaurant; we're a celebration of coastal flavors and culinary craftsmanship. Our commitment to delivering the freshest, most exquisite dishes is showcased in our signature Grilled Salmon Salad with Lime and Herbs. We take pride in sourcing premium, sustainably caught salmon, and then marinating it in zesty lime and aromatic herbs before grilling it to perfection.</p>
                            <hr class="border-2">
                            <div class="info-wrapper">
                                <div class="more"><a href="" class="link-btn blck" tabindex="0">Read More <i class="ti-arrow-right"></i></a></div>
                                <div class="icon ti-calendar"> 27 sep 2023</div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="chef-recommends-2 mb-90 animate-box" data-animate-effect="fadeInUp">Z
                        <figure><img src="img/news/s3.jpg" alt="" class="img-fluid"></figure>
                        <div class="caption">
                            <h3><a href="#0">Drinks</a></h3>
                            <h4>The Best Champagne For All of Your Celebrations</h4>
                            <p>Restaurant vulputate massa sit amet ravida haretra nuam enim mi obortis eset uctus enec accumsan eu justo aliquam sit amet auctor orci donec vitae vehicula risus duise nunc sapien accumsan.</p>
                            <hr class="border-2">
                            <div class="info-wrapper">
                                <div class="more"><a href="post.html" class="link-btn blck" tabindex="0">Read More <i class="ti-arrow-right"></i></a></div>
                                <div class="icon ti-calendar"> 24 Dec 2023</div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php
    
    
    
    include('footer.php');
    // jQuery
    include('scriptlinks.php');
    ?>
    
</body>

<!-- Mirrored from duruthemes.com/demo/html/candore/demo1/team.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Jul 2023 12:47:08 GMT -->
</html>

<?php } ?>    

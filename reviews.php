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
        <div class="row">
                        <div class="col-md-12">
                            <ul class="accordion-box clearfix">
                                <li class="accordion block">
                                    <div class="acc-btn size-20">How can I book private dinner?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn size-20">How frequently do you change the menu?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn size-20">How do I change / cancel a reservation?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn size-20">What is the special menu offer?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn size-20">How do I cancel a booking?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn size-20">What happens if I don't reconfirm my booking?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn size-20">How do I Claim a Free Coupon?</div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">Restaurant ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
    <?php } ?>
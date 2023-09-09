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
    <!-- Header Banner / full-height -->
    <div class="banner-header full-height valign bg-img bg-fixed" data-overlay-dark="7" data-background="img/banner12.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="v-middle caption">
                        <h5>Location</h5>
                        <h1>Contact Us <span>Get In Touch</span></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- arrow down -->
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>
    <!-- Contact -->
    <section class="info-box section-padding pb-0" data-scroll-index="1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="item">
                            <span class="icon ti-location-pin"></span>
                            <div class="cont">
                                <h5>Address</h5>
                                <p>1616 Broadway NY, 10001 USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <span class="icon ti-mobile"></span>
                            <div class="cont">
                                <h5>Phone</h5>
                                <h6><a href="tel:8551004444">855 100 4444</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <span class="icon ti-email"></span>
                            <div class="cont">
                                <h5>e-Mail</h5>
                                <p>info@luxuryhotel.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <section class="section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="section-head mb-20">
                        <div class="section-subtitle">Candóre Restaurant</div>
                        <div class="section-title mb-20">Get in touch</div>
                        <p>You have a piece of advice or a suggestion that you would like to share with us? Feel free to contact us.</p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="contact-form">
                    <div class="booking-inner clearfix">
                                <form  class="form1 clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input1_wrapper">
                                                <label>Name</label>
                                                <div class="input2_inner">
                                                    <input type="text" class="form-control input" placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input1_wrapper">
                                                <label>Phone</label>
                                                <div class="input2_inner">
                                                    <input type="text" class="form-control input" placeholder="Phone" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input1_wrapper">
                                                <label>e-Mail</label>
                                                <div class="input2_inner">
                                                    <input type="email" class="form-control input" placeholder="e-Mail" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input1_wrapper">
                                                <label>Subject</label>
                                                <div class="input2_inner">
                                                    <input type="text" class="form-control input" placeholder="Subject" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Message" required></textarea>
                                        </div>
                                        <div class="col-md-12 mb-30">
                                            <button type="submit" class="btn-form1-submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
    </div>
        <!-- Maps -->
        <div class="full-width">
        <div class="no-spacing map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.055619720342!2d-73.9842269!3d40.7608014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258560d8ef183%3A0xc4e46289adc9c7c8!2s1616%20Broadway%2C%20New%20York%2C%20NY%2010001%2C%20Amerika%20Birle%C5%9Fik%20Devletleri!5e0!3m2!1str!2str!4v1668967163316!5m2!1str!2str" frameborder="0" class="google-maps" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
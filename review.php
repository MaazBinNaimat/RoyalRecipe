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

    
    ?>

    <!-- main -->
    <div class="container pt-5">
        <div class="row">
            <div class="col-6">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="menubook.php">Recipes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Review</li>
                    </ol>
                </nav>
            </div>

            <div class="col-6 text-end">
                <a href="logout.php" class="btn btn-outline-primary">Logout</a>
            </div>
        </div>
    </div>

    <section>

        <div class="container pb-5">
            <form action="updateprofile.php" method="get">
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
            </form>
        </div>
    </section>




    <!-- Footer -->
    <?php
    
    
   
    // jQuery
    include('scriptlinks.php');
    ?>
    <?php } ?>

</body>

</html>
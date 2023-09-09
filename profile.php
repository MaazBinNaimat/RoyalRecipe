<?php
include("session.php");

?>
<!DOCTYPE html>
<html lang="eng">

<!-- head tag -->
<?php
include('headtag.php');
if(isset($_GET['id'])){
  $id = $_GET['id'];
   // Prepare and execute the query
   $query = $pdo->prepare("SELECT * FROM users WHERE u_id = :id");
   $query->bindParam(':id', $id);
   $query->execute();

   // Fetch user data
   $user = $query->fetch(PDO::FETCH_ASSOC);

  
}
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
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
            <div class="card mb-4">
              <div class="card-body text-center">
                <?php
                $uid = $_SESSION['uid'];
                if($uid==2){
                  ?>
                  
                <img src="chefPanel/img/users/<?php echo $user['Profile_Picture'];?>" alt="Profile"
                  class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                  <?php
                }else {
                  ?>
                  <img src="AdminPanel/img/user1.jpg" alt="Profile"
                  class="rounded-circle img-fluid" style="width: 110px; height: 110px;">
                  <?php
                }
                ?>
                <h5 class="my-3" name="u_name" value="<?php echo $user['u_name']; ?>">
                  <?php echo $user['u_name'] ?>
                </h5>
                <p class="text-muted mb-1" name="address" value="<?php echo $user['address']; ?>">
                  <?php echo $user['address'] ?>
                </p>
                <p class="text-muted mb-4" name="phone_num" value="<?php echo $user['phone_num']; ?>">
                  <?php echo $user['phone_num'] ?>r
                </p>
                <div class="d-flex justify-content-center mb-2">

                  <button type="button" class="button-3"><a
                      href="updateprofile.php?id=<?php echo $user['u_id'];?>">Edit Profile</a></button>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Full Name</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $user['u_name'] ?>
                    </p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $user['u_email'] ?>
                    </p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $user['phone_num'] ?>
                    </p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">SpecialtyExpertise</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $user['SpecialtyExpertise'] ?>
                    </p>
                  </div>
                </div>
                <hr>


                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                      <?php echo $user['address'] ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!--  -->
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

</body>

</html>
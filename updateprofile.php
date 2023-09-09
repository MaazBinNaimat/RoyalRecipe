<?php
include("session.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $pdo->prepare('SELECT * FROM users WHERE u_id = :id');
    $query->bindParam(':id', $id);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["update_profile"])) {
        $username = $_POST["username"];
        $phone_num = $_POST["phone_num"];
        $address = $_POST["address"];
        $u_email = $_SESSION["uemail"];

        // Check if user email exists
        $query_check = $pdo->prepare('SELECT u_email FROM users WHERE u_email = :email');
        $query_check->bindParam(':email', $u_email);
        $query_check->execute();

        if ($query_check->rowCount() === 1) {
            if (!empty($_FILES["updateprofile"]["name"])) {
                $filename = $_FILES["updateprofile"]["name"];
                $tmpname = $_FILES["updateprofile"]['tmp_name'];
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $destination = "chefPanel/img/users/" . $filename;

                if ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp") {
                    if (move_uploaded_file($tmpname, $destination)) {
                        $query = $pdo->prepare("UPDATE users SET u_name = :u_name, phone_num = :phone_num, address = :address, Profile_Picture = :profile WHERE u_id = :pid");
                        $query->bindParam(":pid", $id);
                        $query->bindParam(":u_name", $username);
                        $query->bindParam(":phone_num", $phone_num);
                        $query->bindParam(":address", $address);
                        $query->bindParam(":profile", $filename);
                        $query->execute();

                        echo "<script>alert('Profile updated successfully with image'); window.location.href = 'profile.php?id=" . $id . "';</script>";
                    }
                }
            } else {
                $query = $pdo->prepare("UPDATE users SET u_name = :u_name, phone_num = :phone_num, address = :address WHERE u_id = :pid");
                $query->bindParam(":pid", $id);
                $query->bindParam(":u_name", $username);
                $query->bindParam(":phone_num", $phone_num);
                $query->bindParam(":address", $address);
                $query->execute();

                echo "<script>alert('Profile updated successfully without image'); window.location.href = 'profile.php?id=" . $id . "';</script>";
            }
        } else {
            echo "<script>alert('Profile already exists. Update failed.'); window.location.href = 'profile.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eng">

<!-- head tag -->
<?php
include('headtag.php');
?>
<body>
    <?php
    // Preloader
    include('preloader.php');
    ?>

    <!-- main -->
    <div class="container-fluid pt-4 px-4 my-3">
        <div class="col px-3 g-4">
            <h3>Update Your Profile</h3>
        </div>
    <div class="row">
      <div class="col-6">
        <nav
          style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
          aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
          </ol>
        </nav>
      
    </div>
  </div>
        <div class="row">
            <form method="post" enctype="multipart/form-data">
                <div class="col-sm-12 col-lg-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Change Your Name</label>
                            <input name="username" value="<?php echo $data["u_name"]; ?>" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Change Your Phone Number</label>
                            <input name="phone_num" value="<?php echo $data["phone_num"]; ?>" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Change Address</label>
                            <input name="address" value="<?php echo $data["address"]; ?>" type="text">
                        </div>
                        <?php
                $uid = $_SESSION['uid'];
                if($uid==2){
                  ?>
                  
                  <div class="mb-3">
                            <label for="formFile" class="form-label">Add Your Profile Image</label>
                            <input name="updateprofile" class="form-control" type="file" id="formFile">
                            <img src="chefPanel/img/users/<?php echo $data['Profile_Picture']; ?>" style="width: 100px;" alt="">
                        </div>
                  <?php
                }else {
                  ?>
                  <div class="mb-3">
                            <img src="AdminPanel/img/user1.jpg" style="width: 100px;" alt="">
                        </div>
                  
                  <?php
                }
                ?>
                        
                        <button type="submit" class="button-5" name="update_profile">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- main end -->
    
    <!-- Footer -->
    <?php
    // jQuery
    include('scriptlinks.php');
    ?>
</body>
</html>

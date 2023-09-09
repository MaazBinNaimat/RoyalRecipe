<?php
include('connection.php');

$user_id = $_GET['uid'];

// Retrieve user data from the database based on the user ID
$userQuery = $pdo->prepare('SELECT u_name, u_email FROM users WHERE u_id = :user_id');
$userQuery->bindParam(':user_id', $user_id);
$userQuery->execute();
$userData = $userQuery->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
    // User not found, redirect to an error page or handle as needed
    header('Location: 404.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Royal | Recipe World | Login</title>
  <link rel="shortcut icon" href="img/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
  .button-1 {
    display: inline-block;
    height: auto;
    padding: 12px 25px;
    border: 1px solid #C19D60;
    border-radius: 0;
    background-color: transparent;
    -webkit-transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    color: #C19D60;
    line-height: 20px;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 3px;
  }

  .button-1:hover {
    border: 1px solid #C19D60;
    background-color: #C19D60;
    color: #fff;
  }
</style>

<body>
  <div class="container">
    <div class="row">
      <!-- Section: Design Block -->
      <section class="text-center">
        <!-- Background image -->
        <div class="p-5 bg-image" style="
        background-image: url('img/banner8.jpg');
        height: 200px; background-position: center; background-size: cover;background-repeat: no-repeat;
        "></div>
        <!-- Background image -->

        <div class="card border-0 mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
          <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
              <div class="col-lg-8">
                <h1 class="fw-bold mb-5"
                  style="color: #C19D60; font-family: 'Libre Caslon Display', serif; text-shadow: 10px 10px 15px #C19D60;">
                  Become A Chef.</h1>
                <form method="post" enctype="multipart/form-data">
                  <!-- name -->
                  <h1>Welcome<span class="display-4"
                      style="color: #C19D60; font-family: 'Libre Caslon Display', serif; text-transform: uppercase;">
                      <?php echo $userData['u_name']; ?>
                    </span></h1>
                  <p style="font-size: 22px; text-decoration: underline;">Email:
                    <?php echo $userData['u_email']; ?>
                  </p>



                  <div class="form-outline mb-3">
                    <input type="text" class="form-control" placeholder="Enter Your Address" name="Address" required />
                  </div>

                  <div class="form-outline mb-3">
                    <input type="number" class="form-control" placeholder="Enter Your Phone Number" name="phone_num"
                      required />
                  </div>

                  <div class="form-outline mb-3">
                    <label for="specialty" class="form-check-label mb-2">Specialty/Expertise</label>
                    <select name="specialty" id="specialty" class="form-control" placeholder="Specialty/Expertise">
                      <option value="Cuisine Type">Cuisine Type</option>
                      <option value="Baking">Baking</option>
                      <option value="Grilling">Grilling</option>
                      <option value="Pastry and Desserts">Pastry and Desserts</option>
                      <option value="Seafood">Seafood</option>
                      <option value="Vegan/Vegetarian">Vegan/Vegetarian</option>
                      <option value="Sushi">Sushi</option>
                      <option value="Healthy Eating">Healthy Eating</option>
                    </select>
                  </div>


                  <div class="form-outline mb-3">
                    <label for="formFile" class="form-label">Insert Your Profile Picture Image</label>
                    <input name="profile_picture" class="form-control" type="file" id="formFile">
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="u_password" required />
                  </div>



                  <!-- Checkbox -->
                  <div class="form-check d-flex justify-content-start mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" />
                    <label class="form-check-label">
                      Show Password
                    </label>
                  </div>

                  <!-- Submit button -->
                  <button type="submit" name="register" class="button-1 rounded btn-block w-50">
                    Registered Now
                  </button>
                  <p class="mt-3">You have already an <a href="login.php">Account</a></p>


              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    </section>
    <!-- Section: Design Block -->
  </div>
  </div>
  </div>
  <!-- php -->
  <?php
if (isset($_POST['register'])) {
  $address = $_POST['Address'];
  $phone_num = $_POST['phone_num'];
  $specialty = $_POST['specialty'];
  $u_password = $_POST['u_password'];

  $passwordCheckStmt = $pdo->prepare('SELECT password FROM users WHERE u_id = :u_id');
  $passwordCheckStmt->bindParam(':u_id', $user_id);
  $passwordCheckStmt->execute();
  $storedPassword = $passwordCheckStmt->fetchColumn();

  if ($u_password === $storedPassword) {
      $profile_picture = $_FILES['profile_picture']['name'];
      $tmp_profile_picture = $_FILES['profile_picture']['tmp_name'];
      $extension = pathinfo($profile_picture, PATHINFO_EXTENSION);
      $destination = 'chefPanel/img/users/'.$profile_picture;

      if ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg') {
          if (move_uploaded_file($tmp_profile_picture, $destination)) {

            $query = $pdo->prepare('UPDATE users SET SpecialtyExpertise = :specialty, Profile_Picture = :Profile_Picture, phone_num = :phone_num, address = :address, Status = "Pending", u_type_id = 2 WHERE u_id = :user_id');
            $query->bindParam(':specialty', $specialty);
            $query->bindParam(':phone_num', $phone_num);
            $query->bindParam(':Profile_Picture', $profile_picture);
            $query->bindParam(':address', $address);
            $query->bindParam(':user_id', $user_id);

            if ($query->execute()) {
                echo "<script>alert('Successfully Registered'); location.assign('login.php');</script>";
                
            } else {
                echo "<script>alert('Error updating user data');</script>";
            }
          } else {
              echo "<script>alert('Error uploading profile picture');</script>";
          }
      } else {
          echo "<script>alert('Invalid profile picture format');</script>";
      }
  } else {
      echo "<script>alert('Invalid Password');</script>";
  }
}

?>

</body>

</html>
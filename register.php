<?php
include('connection.php')
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
          <h1 class="fw-bold mb-5" style="color: #C19D60; font-family: 'Libre Caslon Display', serif; text-shadow: 10px 10px 15px #C19D60;">Register Here.</h1>
          <form method="post">
            <!-- name input -->
            <div class="form-outline mb-3">
              <input type="text" class="form-control" placeholder="Name" name="u_name" required />
            </div>

            <!-- Email input -->
            <div class="form-outline mb-3">
              <input type="email" class="form-control" placeholder="Email Address" name="u_email" required />
            </div>


            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" class="form-control" placeholder="Password" name="u_password" required />
            </div>

            <!-- Confirem Password input -->
            <div class="form-outline mb-3">
              <input type="password" class="form-control" placeholder="Confirem Your Password" name="confirem_password" required />
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input me-2" type="checkbox" value=""/>
              <label class="form-check-label">
                Show Password
              </label>
            </div>

            <!-- Submit button -->
            <button type="submit" name="register" class="button-1 rounded btn-block w-50">
              Registered Now
            </button><br>
            <span>You  have already 
                  <a href="login.php">Acount</a></span>

            
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
  $u_name = $_POST['u_name'];
  $u_email = $_POST['u_email'];
  $u_password = $_POST['u_password'];
  $confirem_password = $_POST['confirem_password'];

  $emailcheck = $pdo->prepare('SELECT u_email FROM users WHERE u_email = :u_email');
  $emailcheck->bindParam('u_email', $u_email);
  $emailcheck->execute();

  if ($emailcheck->rowcount() === 0) {
    
    if ($confirem_password === $u_password) {

      $query = $pdo->prepare('INSERT INTO users(u_name, u_email, u_type_id, password) VALUES (:u_name,:u_email, 3, :u_password)');
      $query->bindParam('u_name', $u_name);
      $query->bindParam('u_email', $u_email);
      $query->bindParam('u_password', $u_password);
      $query->execute();

        echo "<script>alert('Successfully Registered'); location.assign('login.php');</script>";
    } else {
        echo "<script>alert('Your Passwords Don\'t Match');</script>";
    }

  }else {
    echo "<script>alert('Email already registered. Please login.'); location.assign('login.php');</script>";
  }

}
?>
</body>

</html>
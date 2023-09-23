<!-- connection to server -->
<?php
include("session.php");

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
        margin-top: -60px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">

          <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
              <div class="col-lg-8">
                <h1 class="fw-bold mb-5"
                  style="color: #C19D60; font-family: 'Libre Caslon Display', serif; text-shadow: 10px 8px 15px #C19D60;">
                  Login.</h1>

                <div class="col-12">
                  <nav
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">login</li>
                    </ol>
                  </nav>
                </div>


              
            <form method="post">

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="u_email" class="form-control" placeholder="Enter Email Address" required />
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="u_password" class="form-control" placeholder="Enter Password" required />
              </div>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" />
                <label class="form-check-label">
                  Show Password
                </label>
              </div>

              <!-- Submit button -->
              <button type="submit" name="login" class="button-1 rounded btn-block w-50 mb-4">
                Login
              </button><br>
              <span>You don't have already
                <a href="register.php">Acount</a></span>
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



</body>

</html>
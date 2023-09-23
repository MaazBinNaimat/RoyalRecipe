<?php
    include('../session.php');
    include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Royal Recipe || Chef Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../adminpanel/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../adminpanel/css/style.css" rel="stylesheet">
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
    font-weight: 400;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 3px;
}
.button-1:hover {
  border: 1px solid #C19D60;
  background-color: #C19D60;
  color: #000;
}

/* button 2 */
.button-2 {
    display: inline-block;
    height: auto;
    padding: 12px 25px;
    border: 1px solid #C19D60;
    border-radius: 0;
    background-color: #C19D60;
    -webkit-transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    color: #fff;
    line-height: 20px;
    font-weight: 400;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 3px;
}
.button-2:hover {
  border: 1px solid #fff;
  background-color: transparent;
  color: #C19D60;
  font-weight: 400;
}
/* button 3 */
.button-3 {
    display: inline-block;
    height: auto;
    padding: 12px 25px;
    border: 1px solid #1b1b1b;
    border-radius: 0;
    background-color: transparent;
    -webkit-transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    color: #1b1b1b;
    line-height: 20px;
    font-weight: 400;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 3px;
}
.button-3:hover {
  border: 1px solid #1b1b1b;
  background-color: #1b1b1b;
  color: #fff;
}
/* button 4 */
.button-4 {
    display: inline-block;
    height: auto;
    padding: 15px 25px;
    border: 1px solid #1b1b1b;
    border-radius: 0;
    background-color: #1b1b1b;
    -webkit-transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    color: #fff;
    line-height: 20px;
    font-weight: 400;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 3px;
}
.button-4:hover {
  border: 1px solid #1b1b1b;
  background-color: transparent;
  color: #1b1b1b;
}

/* button 5 */
.button-5 {
    display: inline-block;
    height: auto;
    padding: 12px 25px;
    border: 1px solid #C19D60;
    border-radius: 0;
    background-color: #C19D60;
    -webkit-transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    transition: border-color 400ms ease, color 400ms ease, background-color 400ms ease;
    color: #fff;
    line-height: 20px;
    font-weight: 400;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 3px;
}
.button-5:hover {
  border: 1px solid #C19D60;
  background-color: transparent;
  color: #fff;
}
</style>


<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem; color:#C19D60;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="chefpanel.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="" style="color:#C19D60;"><i class="fa fa-hashtag me-2"></i>Chef</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <?php
                        $uid = $_SESSION['id'];
                        
// Prepare and execute the query to fetch the user's image
$query = $pdo->prepare("SELECT Profile_Picture FROM users WHERE u_id = :uid");
$query->bindValue(':uid', $uid);
$query->execute();

// Fetch the result
$userData = $query->fetch(PDO::FETCH_ASSOC);

if ($userData) {
    // User image found
    $userImage = $userData['Profile_Picture'];
    echo '<img class="rounded-circle" style="width: 40px; height: 40px;" src="img/users/' . $userImage . '" alt="User Image">';
    ?>
    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
    <?php
} else {
    // User not found or image doesn't exist
    echo '<img src="../AdminPanel/img/user.jpg" alt="Default Image">';
}
?>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['uname'];?></h6>
                        <span>Chef</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="chefboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="viewrecipe.php" class="nav-item nav-link mt-1"><i class="fa fa-th me-2"></i>View Recipes</a>
                    <a href="addrecipe.php" class="nav-item nav-link mt-1"><i class="fa fa-th me-2"></i>Add Recipe</a>
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="chefboard.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class=" mb-0" style="color:#C19D60;"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color:#C19D60;"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    
                    <a href="../index.php" class="button-2 me-3">Site</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?php
                            // 
                            if ($userData) {
                                // User image found
                                $userImage = $userData['Profile_Picture'];
                                echo '<img class="rounded-circle me-lg-2" style="width: 40px; height: 40px;" src="img/users/' . $userImage . '" alt="User Image">';
                             
                            } else {
                                // User not found or image doesn't exist
                                ?>
                                <img class="rounded-circle me-lg-2" src="../AdminPanel/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <?php
                            }
                            // 
                        ?>
                          
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['uname'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a class="dropdown-item" href="../profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


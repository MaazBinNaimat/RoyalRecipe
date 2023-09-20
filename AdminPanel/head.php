<?php
include("../session.php");
    include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="" style="color:#C19D60;"><i class="fa fa-hashtag me-2"></i>Admin</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['uname'];?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="category.php" class="nav-item nav-link  mt-1"><i class="fa fa-th me-2"></i>Categories</a>
                    <a href="chefs.php" class="nav-item nav-link  mt-1"><i class="fa fa-user me-2"></i>Chefs</a>
                    <a href="users.php" class="nav-item nav-link  mt-1"><i class="fa fa-users me-2"></i>Users</a>
                    <a href="recipe.php" class="nav-item nav-link  mt-1"><i class="fa fa-keyboard me-2"></i>Recipes</a>
                    
                    <a href="downloadrecipes.php" class="nav-item nav-link  mt-1"><i class="fa fa-chart-bar me-2"></i>Downloaded Recipes</a>
                    
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class=" mb-0" style="color:#C19D60;"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color:#C19D60;"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <a href="../index.php" class="button-5">Site</a>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2" style="color:#C19D60;"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <?php
                        if (isset($_SESSION['pending_notifications']) && !empty($_SESSION['pending_notifications'])) {
                            foreach ($_SESSION['pending_notifications'] as $notification) {
                                preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $notification, $matches);

                                if (!empty($matches[1])) {
                                    $timestamp = strtotime($matches[1]);
                                    $timeAgo = time() - $timestamp;
                                    $timeAgoText = getTimeAgo($timeAgo);
                                } else {
                                    $timeAgoText = "Unknown";
                                }
                                ?>
                                <a href="recipe.php?id=<?php echo $recipeId; ?>" class="dropdown-item">
                                    <h6 class="fw-normal mb-0"><?php echo $notification; ?></h6>
                                    <small><?php echo $timeAgoText; ?></small>
                                </a>
                                <hr class="dropdown-divider">
                                <?php
                            }
                        } else {
                            ?>
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Notification area clear</h6>
                            </a>
                            <hr class="dropdown-divider">
                            <?php
                        }

                        function getTimeAgo($timeAgo) {
                            $timeAgoInMinutes = floor($timeAgo / 60);
                            
                            if ($timeAgoInMinutes < 1) {
                                return "Just now";
                            } elseif ($timeAgoInMinutes == 1) {
                                return "1 minute ago";
                            } elseif ($timeAgoInMinutes < 60) {
                                return $timeAgoInMinutes . " minutes ago";
                            } elseif ($timeAgoInMinutes < 120) {
                                return "1 hour ago";
                            } elseif ($timeAgoInMinutes < 1440) {
                                return floor($timeAgoInMinutes / 60) . " hours ago";
                            } elseif ($timeAgoInMinutes < 2880) {
                                return "1 day ago";
                            } else {
                                return floor($timeAgoInMinutes / 1440) . " days ago";
                            }
}
?>

                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['uname']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a class="dropdown-item" href="../profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


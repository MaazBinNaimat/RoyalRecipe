<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <div class="logo-wrapper">
            <a class="logo" href="index.php">
                <img src="img/logo.png" class="logo-img" alt="img">
            </a>
            <!-- <a class="logo" href="index.html">
                    <h2>Royal <span>Recipeee</span></h2>
                </a> -->
        </div>
        <!-- Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span
                class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="menubook.php">Recipes</a></li>
                <!-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Recipes <i
                                class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="menubook.html" class="dropdown-item"><span>BBQ </span></a></li>
                            <li><a href="menubook2.html" class="dropdown-item"><span>Desserts</span></a></li>
                            <li><a href="menubook3.html" class="dropdown-item"><span>Fast Food</span></a></li>
                            <li><a href="menubook4.html" class="dropdown-item"><span>Breakfast</span></a></li>
                            <li><a href="menubook5.html" class="dropdown-item"><span>Cookies & Cakes</span></a></li>
                            <li><a href="menubook6.html" class="dropdown-item"><span>Beverages</span></a></li>
                        </ul>
                    </li> -->
                <li class="nav-item"><a class="nav-link" href="team.php">chefs</a></li>
                
                <li class="nav-item"><a class="nav-link" href="reviews.php">Reviews</a></li>
                <!-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Blog <i
                                class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.html" class="dropdown-item"><span>Blog 01</span></a></li>
                            <li><a href="blog2.html" class="dropdown-item"><span>Blog 02</span></a></li>
                            <li><a href="blog3.html" class="dropdown-item"><span>Blog 03</span></a></li>
                            <li><a href="post.html" class="dropdown-item"><span>Post Single</span></a></li>
                        </ul>
                    </li> -->
                <!-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Shop <i
                                class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="shop.html" class="dropdown-item"><span>Product List</span></a></li>
                            <li><a href="single-product.html" class="dropdown-item"><span>Product Single</span></a></li>
                            <li><a href="cart.html" class="dropdown-item"><span>Cart</span></a></li>
                        </ul>
                    </li> -->
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
            <!-- Cart -->

            <!-- registration btn -->

            <div class="cart">
                <?php
                    $u_type = $_SESSION['uid'];
                    $u_status = $_SESSION['ustatus'];
                    $query=$pdo->prepare("select * from users where u_type_id=:u_type");
                    $query->bindParam("u_type",$u_type);
                    $query->execute();
                        if ($u_type == 3) {
                    ?><span style="text-transform: capitalize; color: rgb(212, 152, 72);" class="px-3">
                    <?php echo $_SESSION['uname']; ?>
                </span>
                <a class="login-btn-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
                <?php       
                        }elseif ($u_type == 2) {
                            if ($u_status == 'Approved') {
                                ?>
                <a href="chefPanel/chefboard.php" class="login-btn-1">Chef Panel</a>
                <a class="login-btn-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
                                <?php    
                            }elseif ($u_status == 'Pending') {
                                ?>
                <!-- <a href="approvalstatus.php" class="login-btn-1">Approval Status</a> -->
                <a class="login-btn-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>                <?php
                            }elseif ($u_status == 'Rejected') {
                                ?>
                <!-- <a href="rejectstatus.php" class="login-btn-1">Chef Rejected</a> -->
<a class="login-btn-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
                <?php
                            }
                            
                            
                        }elseif ($u_type == 1) {
                            ?>
                <a href="AdminPanel/index.php" class="login-btn-1">Admin Panel</a>
<a class="login-btn-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>                <?php
                            
                        }else {
                            ?>
                <a href="login.php" class="login-btn-1">Log in</a>
                <a href="register.php" class="login-btn-1">Register</a>
                <?php
                        }
                    ?>
            </div>


            <!-- registration btn end -->

        </div>
    </div>
</nav>
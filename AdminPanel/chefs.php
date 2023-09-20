<?php
 include('head.php');
 if($_SESSION['uid']==1){
?>
<div class="container my-5 ">
    <h1 class="display-4">Chefs</h1>
    <div class="container-fluid text-end">
        <a href="approvedchefs.php" class="button-2">AProved chefs</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Chefs</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Chef Name</th>
                                <th scope="col">Joining Date</th>
                                <th scope="col">Chef Status</th>
                                <th scope="col">Chef Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $query = $pdo->query('select * from users where u_type_id = 2');
                        $result = $query->fetchall(PDO::FETCH_ASSOC);
                        foreach ($result as $data) {
                            ?>
                        
                        <tbody>
                        <tr class="">
                        <td>
                        <?php echo $data['u_id'];?>
                    </td>
                    <td>
                        <?php echo $data['u_name'];?>
                    </td>
                    <td>
                        <?php echo $data['u_email'];?>
                    </td>
                    <td>
                        <?php echo $data['u_email'];?>
                    </td>
                    <td>
                        <?php echo $data['Status'];?>
                    </td>
                    <td collspan="2">
                    <form method="post">
                            <input type="hidden" name="chef_id" value="<?php echo $data['u_id']; ?>">
                            <button class="button-1" type="submit" name="approve">
                                <!-- <a href="?uid="> -->
                                Approve
                            <!-- </a> -->
                        </button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="chef_id" value="<?php echo $data['u_id']; ?>">
                            <button class="button-3 my-1" type="submit" name="reject">Reject</button>
                        </form>
                    <form action="" method="get">
                            <a href="?d_id=<?php echo $data['u_id']; ?>" class="button-4">Delete</a>    
                        </form>
                    </td>
                        </tr>
                        </tbody>
                        <?php
                        }
                        if (isset($_GET['d_id'])) {
                            $id = $_GET['d_id'];
                            $query= $pdo->prepare("delete from categories where c_id =:pid");
                                $query->bindParam("pid",$id);
                                $query->execute();
                                echo "<script>
                                   alert('delete category successfully');
                                    location.assign('category.php');
                                    </script>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
   

// Handle chef approval
if (isset($_POST['approve'])) {
    $chef_id = $_POST['chef_id'];
    // Update the recipe status to "Approved" in the database
    $updateQuery = $pdo->prepare("UPDATE users SET status = 'Approved' WHERE u_id = :chef_id");
  
    $updateQuery->bindParam("chef_id", $chef_id);
    $updateQuery->execute();
    // Unset and destroy the session
    session_unset();
    session_destroy();
    
    // Start a new session
    session_start();
    echo "<script>alert('Chef approved successfully');
    location.assign('chefs.php');
    
    </script>";

}

// Handle recipe rejection
if (isset($_POST['reject'])) {
    $chef_id = $_POST['chef_id'];
    // Update the recipe status to "Rejected" in the database
    $updateQuery = $pdo->prepare("UPDATE users SET status = 'Rejected' WHERE u_id = :chef_id");
    $updateQuery->bindParam("chef_id", $chef_id);
    $updateQuery->execute();
    // Unset and destroy the session
    session_unset();
    session_destroy();
    
    // Start a new session
    session_start();
    echo "<script>alert('Chef rejected successfully');

    </script>";
}

?>
<?php
}
else{
    echo "<script>location.assign('../index.php')</script>";
}
?>

<?php
    include('foot.php');
?>
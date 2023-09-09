<?php
    include('head.php');
    if($_SESSION['uid']==1){
?>
<div class="container my-5 ">
    <h1 class="display-4">Chefs</h1>
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
                                <th scope="col">Chef Rating</th>
                                <th scope="col">Chef Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $query = $pdo->query('select * from users where u_type_id = 3');
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
                        <?php echo $data['u_email'];?>
                    </td>
                    <td collspan="2">
                    <form action="" method="get">
                            <a href="?d_id=<?php echo $data['u_id']; ?>" class="btn btn-danger rounded-pill">Delete</a>    
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
}
else{
    echo "<script>location.assign('../index.php')</script>";
}
?>
<?php
    include('foot.php');
?>
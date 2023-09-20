<?php
    include('head.php');
    if($_SESSION['uid']==1){
?>
<div class="container my-5 ">
    <h1 class="display-5">Categories</h1>
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-3">
            <a href="createcategory.php" type="button" class="text-end mb-3 rounded-pill m-2 button-5">Add Category</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Date</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <?php
            $query = $pdo -> query("select * from categories");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $data) {
                
            ?>
                        <tbody>
                        <tr class="">
                    <td>
                        <?php echo $data['c_id'];?>
                    </td>
                    <td>
                        <?php echo $data['c_name'];?>
                    </td>
                    <td>
                        <?php echo $data['c_uplaod_date'];?>
                    </td>
                    <td><img src="img/<?php echo $data['c_img'];?>" width="100px"></td>
                    <td collspan="2">
                        <form action="" method="get">
                            <a href="catupdate.php?id=<?php echo $data['c_id']; ?>" class="btn button-3 mb-1">Update</a>    
                        </form>
                        <form action="" method="get">
                            <a href="?d_id=<?php echo $data['c_id']; ?>" class="button-4 ">Delete</a>    
                        </form>
                    </td>
                </tr>
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
                        </tbody>
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
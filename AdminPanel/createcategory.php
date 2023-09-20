<?php
    include('head.php');
    if($_SESSION['uid']==1){
?>

<div class="container-fluid pt-4 px-4 my-3">
    <div class="col p-3 g-4">
        <h3 class="display-5">Add Your Category</h3>
    </div>
    <div class="row">

            <form method="post" enctype="multipart/form-data">
            <div class="col-sm-12 col-lg-10 w-100">
                <div class="bg-light rounded h-100 p-4">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <input name="category" type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Add Your Product Image</label>
                            <input name="catimg" class="form-control" type="file" id="formFile">
                        </div>

                        <button type="submit" class="button-5 mt-3" name="addcat">Add Category</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php  // add category
    if (isset($_POST['addcat'])) {
        $catname = $_POST['category'];
        $catimg = $_FILES['catimg']['name'];
        $tmpcatimg = $_FILES['catimg']['tmp_name'];
        $catimg_size = $_FILES['catimg']['size'];
        $extension = pathinfo($catimg,PATHINFO_EXTENSION);
        $destination = 'img/' . $catimg;
        if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
            if (move_uploaded_file($tmpcatimg,$destination)) {
                $query_check = $pdo -> prepare('select c_name from categories where c_name = :name');
                $query_check->bindParam('name',$catname);
                $query_check->execute();
                if ($query_check->rowcount() === 0) {
                    $query = $pdo -> prepare("insert into categories (c_name, c_img) values (:catname,:catimg)");
                    $query->bindParam('catname',$catname);
                    $query->bindParam('catimg',$catimg);
                    $query->execute();
                    echo"<script>
                    alert('category added succesfully')
                    location.assign('category.php');
                    </script>";
                }else {
                    echo "<script>alert('Category already existe');
                    location.assign('createcategory.php');</script>";
                }
            }
        }
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
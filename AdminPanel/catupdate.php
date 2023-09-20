<?php
include("head.php");
if($_SESSION['uid']==1){
?>
<div class="container-fluid pt-4 px-4 my-3">
    <div class="col p-3 g-4">
        <h3 class="display-5">Update Category</h3>
    </div>
    <div class="row">
    <?php
    if (isset($_GET['id'])) {
        $cid = $_GET['id'];
        $query = $pdo->prepare('SELECT * FROM categories WHERE c_id = :id');
        $query->bindParam('id', $cid);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
    ?>
        <form method="post" enctype="multipart/form-data">
            <div class="col-sm-12 col-lg-12">
                <div class="bg-light rounded h-100 p-4">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Change Gategory Name</label>
                        <input name="updcatname" value="<?php echo $data["c_name"]; ?>" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Add Your Product Image</label>
                        <input name="updcatimg" class="form-control mb-3" type="file" id="formFile">
                        <img src="img/<?php echo $data['c_img'];?>" width="100px" alt="">
                    </div>

                    <button type="submit" class="button-4 mt-3" name="updatecat">Update Category</button>
                </div>
            </div>
        </form>
        <?php
            }
            if(isset($_POST["updatecat"])){
                
                                
                $cname= $_POST["updcatname"];
                $query_check = $pdo -> prepare('select c_name from categories where c_name = :name');
                $query_check->bindParam('name',$cname);
                $query_check->execute();
                if ($query_check->rowcount() === 0) {
                if(!empty($_FILES["updcatimg"]["name"])){
                    $filename = $_FILES["updcatimg"]["name"];
                    $tmpname= $_FILES["updcatimg"]['tmp_name'];
                    $extension = pathinfo($filename,PATHINFO_EXTENSION);
                    $destination = "img/" . $filename;
                        if($extension=="jpg" || $extension=="png" ||$extension=="jpeg" || $extension=="webp" ){
                            if(move_uploaded_file($tmpname,$destination)){
                            $query=$pdo->prepare("update categories  set c_name =:cname, c_img=:cimg where c_id =:pid");
                            $query->bindParam("pid",$cid);
                            $query->bindParam("cname",$cname);
                            $query->bindParam("cimg",$filename);
                            $query->execute();
                            echo "
                            <script>alert('update category successfully with image')
                            location.assign('category.php');</script>
                            ";

                            }
                    }
                }else{
                    $query=$pdo->prepare("update categories  set c_name =:cname where c_id =:pid");
                    $query->bindParam("pid",$cid);
                    $query->bindParam("cname",$cname);
                    $query->execute();
                    echo "
                    <script>alert('update category successfully without image')
                    location.assign('category.php');</script>
                    "; 
                }
            }else {
                echo "<script>alert('Category already exists. Update failed.'); location.assign('updatecategory.php');</script>";
            }
            }
            ?>
        
    </div>
</div>
<?php
}
else{
    echo "<script>location.assign('../index.php')</script>";
}
?>
<?php
include("foot.php");
?>
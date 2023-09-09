<?php
include('head.php');
if($_SESSION['uid']==1){

// Fetch approved chef details
$approvedChefQuery = $pdo->prepare("SELECT * from users WHERE status = 'approved';
");
$approvedChefQuery->execute();
$approvedChefs = $approvedChefQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row ">
    <div class="p-5 col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Approved Chefs</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Chef Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Specialty/Expertise</th>
                        <th scope="col">Chef Number</th>
                        <th scope="col">Address</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($approvedChefs as $index => $chefs) { ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?php echo $chefs['u_name']; ?></td>
                            <td><?php echo $chefs['u_email']; ?></td>
                            <td><?php echo $chefs['SpecialtyExpertise']; ?></td>
                            <td><?php echo $chefs['phone_num']; ?></td>
                            <td><?php echo $chefs['address']; ?></td>
                            <!-- Add more columns as needed -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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

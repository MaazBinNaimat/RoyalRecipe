 
 <?php
 session_start(); // Start the session  
 include('connection.php');
 
  if (isset($_POST['login'])) {
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    
    $query = $pdo->prepare('SELECT * FROM users WHERE u_email=:u_email AND password=:u_password');
    $query->bindParam(':u_email', $u_email);
    $query->bindParam(':u_password', $u_password);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($result) { 
        $_SESSION["uemail"]=$result['u_email'];
        $_SESSION["uname"]=$result['u_name'];
        $_SESSION["uid"]=$result['u_type_id'];
        $_SESSION['id']=$result['u_id'];
        $_SESSION["ustatus"]=$result['Status'];

        if ($_SESSION['uid']==1) { 
            
            echo "<script>
                    alert('Logged in successfully with admin');
                    location.assign('AdminPanel/index.php');
                  </script>";
        } 
        if ($_SESSION['uid'] == 2) {     

            if ($_SESSION['ustatus'] == 'Approved') {
              
              echo "<script>
                      alert('Logged in successfully with cheaf');
                      location.assign('chefPanel/chefboard.php');
                    </script>";
            }
            elseif ($_SESSION['ustatus'] == 'Rejected' || $_SESSION['ustatus'] == 'Pending') {
              echo "<script>
              alert('Logged in successfully');
              location.assign('index.php');
            </script>";
            }
        }
        else {
    
            echo "<script>
                    alert('Logged in successfully');
                    location.assign('index.php');
                  </script>";
        }
    } 
    
  }
    ?>
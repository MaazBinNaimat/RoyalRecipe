<?php
session_start();
session_unset();
echo "<script>
alert('Logged out');
location.assign('login.php');
</script>";
?>



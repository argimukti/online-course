<?php include "inc_header.php"; 
if($_SESSION['members_email'] == ''){
  header("location:login.php");
  exit();
}
?>;

<h3>Hallo selamat datang <?= $_SESSION["members_nama_lengkap"]; ?></h3>
<?php include "inc_footer.php" ?>;
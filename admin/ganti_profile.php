<?php include "inc_header.php";

$error = "";
$sukses = "";
if (isset($_POST['simpan'])) {
  
    $password_lama = $_POST["password_lama"];
    $password = $_POST["password"];
    $konfirmasi = $_POST["konfirmasi"];

    $sqli1 = "SELECT * FROM admin WHERE username = '" . $_SESSION['admin_username'] . "'";
    $q1 = mysqli_query($conn, $sqli1);
    $r1 = mysqli_fetch_array($q1);
    if (md5($password_lama) != $r1['password']) {
        $error = "<li> Password yang dimasukan tidak sesuai</li>";
    }
    if ($password_lama == '' or $konfirmasi == '' or $password == '') {
        $error = "<li>Silahkan masukan password lama , password baru dan konfirmasi password</li>";
    }
    if ($password != $konfirmasi) {
        $error = "<li> Silahakan Masukan Password dan Konfirmasi Password yang sama</li>";
    }
    if (strlen($password) < 6) {
        $error .= "<li>Password Maksimal 6 karakter</li>";
    }

    if(empty($error)){
      $sqli1 = "UPDATE admin SET password = md5($password) WHERE username = '".$_SESSION['admin_username']."'";
      mysqli_query($conn, $sqli1);
      $sukses = "Data berhasil diganti";
    }
}

?>
<h1>Ganti Password Akun</h1>
<?php 
if($sukses){
  ?>
  <div class="alert alert-primary">
    <?= $sukses; ?>
  </div>
<?php
}
?>
<?php 
if($error){
  ?>
  <div class="alert alert-danger">
    <ul><?= $error; ?></ul>
  </div>
<?php
}
?>
<form action="" method="post">
 <div class="mb-3 row">
  <label for="password_lama" class="col-sm-3 col-form-label">
    Password Lama
    </label>
    <div class="col-sm-9">
      <input type="password" name="password_lama" id="password_lama" class="form-control">
    </div>

 </div>
 <div class="mb-3 row">
  <label for="password" class="col-sm-3 col-form-label">
    Password Baru
    </label>
    <div class="col-sm-9">
      <input type="password" name="password" id="password" class="form-control">
    </div>

 </div>
 <div class="mb-3 row">
  <label for="konfirmasi" class="col-sm-3 col-form-label">
    Konfirmasi Password
    </label>
    <div class="col-sm-9">
      <input type="password" name="konfirmasi" id="konfirmasi" class="form-control">
    </div>

 </div>
 <div class="mb-3 row">
  <div class="col-sm-3"></div>
    <div class="col-sm-9">
      <button type="submit" class="btn btn-primary" name="simpan" value="Ganti Password Baru">Ganti Password</button>
    </div>
 </div>
</form>

<?php include "inc_footer.php"?>
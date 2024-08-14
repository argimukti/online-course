<?php
session_start();
if(isset($_SESSION["admin_username"]) != ''){
  header("location:index.php");
  exit();
}
include "../inc/inc_koneksi.php";

$username = "";
$password = "";
$err = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == '' or $password == '') {
        $err = "Silahkan masukan semua isian";
    } else {
        $sqli1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($conn, $sqli1);
        $r1 = mysqli_fetch_array($q1);
        $n1 = mysqli_num_rows($q1);

        if ($n1 < 1) {
            $err = "Username tidak ditemukan";
        } elseif ($r1["password"] != md5($password)) {
            $err = "Password yang kamu masukan tidak sesuai";
        } else {
            $_SESSION["admin_username"] = $username;
            header("location:index.php");
            exit();
        }
    }

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body style="width: 100%; max-width: 330px; margin:auto;padding:15px ;">
    <form action="" method="post">
      <h1>Login Admin</h1>
      <?php 
      if($err){
        ?>
        <div class="alert alert-danger">
          <?= $err; ?>
        </div>
        <?php
      }
      ?>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username Anda" value="<?=$username;?>"/>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" />
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>

    </form>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
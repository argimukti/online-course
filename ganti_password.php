<?php include "inc_header.php";

if (isset($_SESSION["members_email"]) != ''){
  header("location:index.php");
  exit();
}

$err      = "";
$sukses   = "";

$email = $_GET["email"];
$token = $_GET["token"];

if($token == '' or $email = ''){
  $err .= "Link tidak valid. Email dan token tidak tersedia";

}else {
  $sqli1 = "SELECT * FROM members WHERE email = '$email' and token_ganti_password = '$token'";
  $q1 = mysqli_query($conn, $sqli1);
  $n1 = mysqli_num_rows($q1);

  if($n1 < 0){
      $err .= "Link tidak valid. Email dan Token tidak sesuai";
  }
}

if(isset($_POST["submit"])){
    $password   = $_POST["password"];
    $konfirmasi = $_POST["konfirmasi"];

    if($password == '' or $konfirmasi == ''){
        $err .= "Silahkan masukan password dan konfirmasi password";
    }elseif($konfirmasi != $password){
        $err  .= "Konfirmasi password tidak sesuai";
    }elseif(strlen($password)<6){
      $err    .= "Jumlah karakter yang diperbolehkan minimal 6 karakter";
    }

    if(empty($err)){
      $sqli1 = "UPDATE members set token_ganti_password = '', password = md5($password) WHERE email = '$email'";
      mysqli_query($conn, $sqli1);
      $sukses = "Password berhasil diganti. Silahkan <a href ='".url_dasar()."/login.php'>login</a>";
    }
}
if ($err){ echo "<div class='error'> $err</div>";}
if ($sukses){ echo "<div class='sukses'> $sukses</div>";}
?>
<h1>Ganti Password</h1>
<form action="" method="post">
  <table>
    <tr>
      <td class="label">
      Password
      </td>
      <td>
        <input type="password" name="password" class="input">
      </td>
    </tr>
    <tr>
      <td class="label">
      Konfirmasi Password
      </td>
      <td>
        <input type="password" name="konfirmasi" class="input">
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" name="submit" value="Ganti Password" class="tbl-biru"></input>
      </td>
    </tr>
  </table>
</form>


<?php include "inc_footer.php" ?>
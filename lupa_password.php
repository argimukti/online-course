<?php include "inc_header.php";

if (isset($_SESSION["members_email"]) != ''){
  header("location:index.php");
  exit();
}

$err      = "";
$sukses   = "";
$email    = "";

if(isset($_POST["submit"])){
  $email=$_POST["email"];
  if($email == ''){
    $err = "Silahkan Masukan Email";
  } else {
    $sqli1 = "SELECT * FROM members WHERE email = '$email'";
    $q1 = mysqli_query($conn, $sqli1);
    $n1 = mysqli_num_rows($q1);

    if($n1 < 1 ){
      $err = "Email : <b>$email</b> tidak ditemukan";
    }
  }
  if (empty($err)){
      $token_ganti_password = md5(rand(0,1000));
      $judul_email          = "Ganti Password";
      $isi_email            = "Seseorang meminta untuk melakukan perubahan password. Silahkan klik link dibawah ini : <br/>";
      $isi_email            .= url_dasar()."/ganti_password.php?email=$email&token=$token_ganti_password";
      kirim_email($email, $email, $judul_email, $isi_email);

      $sqli1 = "UPDATE members SET token_ganti_password = '$token_ganti_password' WHERE email = '$email'";
      mysqli_query($conn, $sqli1);
      $sukses = "Link ganti password sudah di kirimkan ke email anda.";
  }
}
if ($err){ echo "<div class='error'> $err</div>";}
if ($sukses){ echo "<div class='sukses'> $sukses</div>";}
?>
<h1>Lupa Password</h1>
<form action="" method="post">
  <table>
    <tr>
      <td class="label">
      Email
      </td>
      <td>
        <input type="text" name="email" class="input" value="<?= $email; ?>">
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" name="submit" value="Lupa Password" class="tbl-biru"></input>
      </td>
    </tr>
  </table>
</form>


<?php include "inc_footer.php" ?>
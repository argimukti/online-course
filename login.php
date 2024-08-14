<?php include "inc_header.php" ?>

<h3>Login Ke Halaman Members</h3>
<?php 
$email  = "";
$password = "";
$err    ="";

if(isset($_POST["login"])){
  $email = $_POST["email"];
  $password = $_POST["password"];

  if($email == "" or $password == ""){
    $err .= "<li>Silahkan masukan semua isian</li>";
  }else{
    $sqli1 = "SELECT * FROM members WHERE email ='$email'";
    $q1 = mysqli_query($conn,$sqli1);
    // $r1 = mysqli_fetch_array($q1);
    // $n1 = mysqli_num_rows($q1);
    if($q1){
      $r1 = mysqli_fetch_array($q1);
      $n1 = mysqli_num_rows($q1);

    }
    if($n1 > 0){
    if($r1["status"] != '1'){
        $err .= "<li> Akun yang kamu miliki belum aktif</li>";
    }
    if($r1["password"] != md5($password) && $r1["status"]='1'){
      $err .= "<li>Password Tidak Sesuai</li>";
    }
  } else {
    $err .=  "<li>Akun tidak ditemukan</li>";
  }

    if(empty($err)){
      $_SESSION["members_email"] = $email;
      $_SESSION["members_nama_lengkap"] = $r1["nama_lengkap"];
      
      header("location:rahasia.php");
      exit();
    }
  }
}
?>
<?php if($err){ echo "<div class='error'><ul class='pesan'>$err</ul></div>";} ?>
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
      <td class="label">
      Password
      </td>
      <td>
      <input type="password" name="password" class="input">
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" value="login" name="login" class="tbl-biru"></td>
    </tr>
    </table>
</form>

<?php include "inc_footer.php" ?>
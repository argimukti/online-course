<?php
include "inc_header.php";

if(isset($_SESSION['members_email']) != ''){
  header("location:index.php");
  exit();
}

$email  = "";
$nama_lengkap ="";
$error  = "";
$sukses = "";
if(isset($_POST["simpan"])){
  $email = $_POST["email"];
  $nama_lengkap = $_POST["nama_lengkap"];
  $password = $_POST["password"];
  $konfirmasi = $_POST["konfirmasi"];

  if($email == '' or $nama_lengkap == '' or $password =='' or $konfirmasi =='' ){;
  $error .="<li>Silahkan Masukan Data</li>";
}
// cek double email atau tidak
if($email !=""){
  $sqli1 = "SELECT email FROM members WHERE email = '$email'";
  $q1 = mysqli_query($conn, $sqli1);
  $n1 = mysqli_num_rows($q1);
  if($n1>0){
    $error .= "<li>Email Sudah Terdaftar</li>";
    }
    // validasi email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error .="<li>Email Tidak Valid!</li>";
    }
  }
  if($password != $konfirmasi){
    $error .="<li>Password tidak sesuai</li>";
  }
  if(strlen($password)<6){
    $error = "<li>Password Minimal 6 karakter</li>";
  }
  if(empty($error)){
    $status = md5(rand(0,1000));
    $judul_email = "Halaman Konfirmasi Pendaftaran";
    $isi_email = "Akun yang kamu miliki dengan email <b>$email</b> telah siap digunakan";
    $isi_email .= "Sebelumnya silahkan melakukan aktifasi email di link di bawah ini:<br/>";
    $isi_email .= url_dasar()."/verifikasi.php?email=$email&kode=$status";

    kirim_email($email, $nama_lengkap, $judul_email, $isi_email);
    $sqli1 = "INSERT INTO members(email, nama_lengkap,password,status) VALUES ('$email', '$nama_lengkap', md5($password), '$status')";
    $q1 = mysqli_query($conn, $sqli1);
    if($q1){
      $sukses = "Proses Berhasil, Silahkan Verifikasi Email";
    }
  }
}



?>


<h3>Pendaftaran</h3>
<?php if($error){echo "<div class='error'><ul>$error</ul></div>";} ?>
<?php if($sukses){echo "<div class='sukses'><ul>$sukses</ul></div>";} ?>
<form action="" method="post">
  <table>
    <tr>
      <td class="label">Email</td>
      <td>
          <input type="text" name="email" id="email" class="input" value="<?=$email;?>">
      </td>
    </tr>
    <tr>
      <td class="label">Nama Lengkap</td>
      <td>
          <input type="text" name="nama_lengkap" id="nama_lengkap" class="input" value="<?=$nama_lengkap;?>">
      </td>
    </tr>
    <tr>
      <td class="label">password</td>
      <td>
          <input type="password" name="password" id="password" class="input">
      </td>
    </tr>
    <tr>
      <td class="label">Konfirmasi Password</td>
      <td>
          <input type="password" name="konfirmasi" id="konfirmasi" class="input">
      <br>
      Sudah punya akun? Silahkan <a href="<?php echo url_dasar()?>/login.php">login</a>
      </td>
    </tr>
    <tr>
      <td>
        <td>
          <input type="submit" name="simpan" value="Simpan" class="tbl-biru"></input>
        </td>
      </td>
    </tr>
  </table>


</form>

<?php
include "inc_footer.php";
?>
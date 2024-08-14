<?php
include "inc_header.php";

if(isset($_SESSION['members_email']) == ''){ //belum login
  header("location:login.php");
  exit();
}

$email  = "";
$nama_lengkap ="";
$error  = "";
$sukses = "";
if(isset($_POST["simpan"])){
  $nama_lengkap = $_POST["nama_lengkap"];
  $password_lama = $_POST["password_lama"];
  $password = $_POST["password"];
  $konfirmasi = $_POST["konfirmasi"];

  if($nama_lengkap == ''){
    $error = "<li>Silahkan Masukan Nama Lengkap</li>";
  }
  if($password !=''){
    $sqli1 = "SELECT * FROM members WHERE email = '".$_SESSION['members_email']."'";
    $q1 = mysqli_query($conn, $sqli1);
    $r1 = mysqli_fetch_array($q1);
    if(md5($password_lama) != $r1['password']){
        $error = "<li> Password yang dimasukan tidak sesuai</li>";
    }
    if($password_lama == '' or $konfirmasi == '' or $password ==''){
      $error = "<li>Silahkan masukan password lama , password baru dan konfirmasi password</li>";
    }
    if($password != $konfirmasi){
      $error = "<li> Silahakan Masukan Password dan Konfirmasi Password yang sama</li>";
    }
    if(strlen($password) < 6 ){
      $error .="<li>Password Maksimal 6 karakter</li>";
    }
  }
  if(empty($error)){
      $sqli1 = "UPDATE members SET nama_lengkap = '".$nama_lengkap."' WHERE email = '".$_SESSION['members_email']."' ";
      $q1 = mysqli_query($conn, $sqli1);
      $_SESSION['members_nama_lengkap'] = $nama_lengkap;

      if($password){
        $sqli2 = "UPDATE members SET password = md5($password) WHERE email = '".$_SESSION['members_email']."'";
        mysqli_query($conn, $sqli2);
      }
      $sukses = "Data sukses";
  }
}



?>


<h3>Ganti Profile</h3>
<?php if($error){echo "<div class='error'><ul>$error</ul></div>";} ?>
<?php if($sukses){echo "<div class='sukses'><ul>$sukses</ul></div>";} ?>
<form action="" method="post">
  <table>
    <tr>
      <td class="label">Email</td>
      <td>
          <?= $_SESSION["members_email"]; ?>
      </td>
    </tr>
    <tr>
      <td class="label">Nama Lengkap</td>
      <td>
          <input type="text" name="nama_lengkap" id="nama_lengkap" class="input" value="<?=$_SESSION['members_nama_lengkap'];?>">
      </td>
    </tr>
    <tr>
      <td class="label">Password Lama</td>
      <td>
          <input type="password" name="password_lama" id="password" class="input">
      </td>
    </tr>
    <tr>
      <td class="label">Password Baru</td>
      <td>
          <input type="password" name="password" id="password" class="input">
      </td>
    </tr>
    <tr>
      <td class="label">Konfirmasi Password</td>
      <td>
          <input type="password" name="konfirmasi" id="konfirmasi" class="input">
      
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
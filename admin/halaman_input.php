<?php include_once("inc_header.php");

$judul ="";
$kutipan ="";
$isi  = "";
$error = "";
$sukses = "";

if(isset($_GET["id"])){
  $id = $_GET["id"];
}else{
  $id = "";
}

if ($id != ""){
  $sqli1 = "SELECT * FROM halaman WHERE id = '$id'";
  $q1 = mysqli_query($conn, $sqli1);
  $r1 = mysqli_fetch_assoc($q1);
  $judul = $r1["judul"];
  $kutipan = $r1["kutipan"];
  $isi = $r1["isi"];

  if($isi == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if(isset($_POST["simpan"])){
  $judul = $_POST["judul"];
  $isi = $_POST["isi"];
  $kutipan = $_POST["kutipan"];
  if($judul =='' or $isi== ''){
    $error = "Silahkan Isi Semua Data";
  } 
  if(empty($error)){
    if($id != ""){
      $sqli1 = "UPDATE halaman SET judul = '$judul', kutipan = '$kutipan', isi = '$isi', tgl_isi = now() WHERE id = '$id'"; 
    } else {

      $sqli1 = "INSERT INTO halaman(judul,kutipan,isi) VALUES('$judul', '$kutipan', '$isi')";
    }
    $q1 = mysqli_query($conn, $sqli1);
    if($q1){
      $sukses = "Sukses Memasukan Data";
    }else{
      $error = "Data Gagal Di Masukan";
    }
  }
}

?>
<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
  <a href="halaman.php"><< Kembali ke Halaman Admin</a>
</div>
<?php 
if($error){
?>
  <div class="alert alert-danger" role="alert">
    <?= $error; ?>
</div>
<?php
}
?>
<?php 
if($sukses){
?>
  <div class="alert alert-primary" role="alert">
    <?= $sukses; ?>
</div>
<?php
}
?>
<form action="" method="post">
<div class="mb-3 row">
    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  id="judul" value="<?= $judul; ?>" name="judul">
    </div>
  </div>
<div class="mb-3 row">
    <label for="kutipan" class="col-sm-2 col-form-label">Kutipan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  id="kutipan" value="<?= $kutipan; ?>" name="kutipan">
    </div>
  </div>
<div class="mb-3 row">
    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
    <div class="col-sm-10">
      <textarea name="isi" id="summernote" class="form-control"><?= $isi; ?></textarea>
    </div>
  </div>
<div class="mb-3 row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
    </div>
  </div>

  
</form>
<?php include("inc_footer.php"); ?>
<?php include_once("inc_header.php");

$nama ="";
$isi  = "";
$foto = "";
$foto_name = "";

$error = "";
$sukses = "";

if(isset($_GET["id"])){
  $id = $_GET["id"];
}else{
  $id = "";
}

if ($id != ""){
  $sqli1 = "SELECT * FROM partners WHERE id = '$id'";
  $q1 = mysqli_query($conn, $sqli1);
  $r1 = mysqli_fetch_assoc($q1);
  $nama = $r1["nama"];
  $isi = $r1["isi"];
  $foto = $r1["foto"];

  if($isi == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if(isset($_POST["simpan"])){
  $nama = $_POST["nama"];
  $isi = $_POST["isi"];
  // Array ( [foto] => Array ( [name] => scoopy2024.jpg [full_path] => scoopy2024.jpg [type] => image/jpeg [tmp_name] => D:\xampp\tmp\php353C.tmp [error] => 0 [size] => 41003 ) )
  if ($_FILES['foto']['name']){
    $foto_name = $_FILES['foto']['name'];
    $foto_file = $_FILES["foto"]["tmp_name"];

    $detail_file = pathinfo($foto_name);
    $foto_ekstensi = $detail_file['extension'];
    // Array ( [dirname] => . [basename] => 664f72a348ccf.jpg [extension] => jpg [filename] => 664f72a348ccf )
    $ekstensi_valid = array("jpg", "jpeg", "png", "gif");
    if(!in_array($foto_ekstensi, $ekstensi_valid)){
      $error = "Silahkan Masukan JPG/JPEG/PNG";

    }

  }
  if($nama =='' or $isi== ''){
    $error = "Silahkan Isi Semua Data";
  } 
  if(empty($error)){
    if($foto_name){
      $direktori = "../images";

      @unlink($direktori."/$foto");//delete data

      $foto_name = "partners_".time()."_".$foto_name;
      move_uploaded_file($foto_file,$direktori."/".$foto_name);

      $foto = $foto_name;
    }else{
      $foto_name = $foto; //memasukan data dari data sebelumnya
    }


    if($id != ""){
      $sqli1 = "UPDATE partners SET nama = '$nama', foto='$foto_name' , isi = '$isi', tgl_isi = now() WHERE id = '$id'"; 
    } else {

      $sqli1 = "INSERT INTO partners(nama,foto,isi) VALUES('$nama', '$foto_name ', '$isi')";
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
<h1>Partners Admin Input Data</h1>
<div class="mb-3 row">
  <a href="partners.php"><< Kembali ke Partners Admin</a>
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
<form action="" method="post" enctype="multipart/form-data">
<div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  id="nama" value="<?= $nama; ?>" name="nama">
    </div>
  </div>
<div class="mb-3 row">
    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
    <?php 
      if($foto){
        echo "<img src='../images/$foto' style = 'max-height:100px;max-width:100px'/>";
      }
      ?>
      <input type="file" class="form-control"  id="foto" name="foto">
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